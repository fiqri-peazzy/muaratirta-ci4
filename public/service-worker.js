// Service Worker for PDAM Muara Tirta PWA
const CACHE_VERSION = "v4.0.0";
const CACHE_NAME = `pdam-mt-${CACHE_VERSION}`;

// Assets to cache immediately
const STATIC_CACHE_URLS = [
  "/",
  "/login",
  "/manifest.json",
  "/backend/assets/css/bootstrap.css",
  "/backend/assets/css/app.css",
  "/backend/assets/js/bootstrap.bundle.min.js",
  "/backend/assets/vendors/bootstrap-icons/bootstrap-icons.css",
  "/backend/assets/images/logo/logo.png",
  "/offline.html",
];

// Dynamic cache for API responses
const DYNAMIC_CACHE = `${CACHE_NAME}-dynamic`;
const IMAGE_CACHE = `${CACHE_NAME}-images`;

// Install event - cache static assets
self.addEventListener("install", (event) => {
  console.log("[Service Worker] Installing...", CACHE_VERSION);

  event.waitUntil(
    caches
      .open(CACHE_NAME)
      .then((cache) => {
        console.log("[Service Worker] Caching static assets");
        return cache.addAll(STATIC_CACHE_URLS);
      })
      .then(() => {
        console.log("[Service Worker] Installation complete");
        return self.skipWaiting();
      })
      .catch((error) => {
        console.error("[Service Worker] Installation failed:", error);
      })
  );
});

// Activate event - clean up old caches
self.addEventListener("activate", (event) => {
  console.log("[Service Worker] Activating...", CACHE_VERSION);

  event.waitUntil(
    caches
      .keys()
      .then((cacheNames) => {
        return Promise.all(
          cacheNames
            .filter((cacheName) => {
              return (
                cacheName.startsWith("pdam-mt-") && cacheName !== CACHE_NAME
              );
            })
            .map((cacheName) => {
              console.log("[Service Worker] Deleting old cache:", cacheName);
              return caches.delete(cacheName);
            })
        );
      })
      .then(() => {
        console.log("[Service Worker] Activation complete");
        return self.clients.claim();
      })
  );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener("fetch", (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // Skip cross-origin requests
  if (url.origin !== location.origin) {
    return;
  }

  // Skip POST requests and API calls
  if (request.method !== "GET") {
    return;
  }

  // Handle different types of requests
  if (request.destination === "image") {
    event.respondWith(handleImageRequest(request));
  } else if (url.pathname.startsWith("/api/")) {
    event.respondWith(handleAPIRequest(request));
  } else {
    event.respondWith(handleStaticRequest(request));
  }
});

// Handle static requests (HTML, CSS, JS)
async function handleStaticRequest(request) {
  try {
    // Try cache first
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }

    // Fetch from network
    const networkResponse = await fetch(request);

    // Cache successful responses
    if (networkResponse && networkResponse.status === 200) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, networkResponse.clone());
    }

    return networkResponse;
  } catch (error) {
    console.error("[Service Worker] Fetch failed:", error);

    // Return offline page for navigation requests
    if (request.mode === "navigate") {
      const offlineResponse = await caches.match("/offline.html");
      if (offlineResponse) {
        return offlineResponse;
      }
    }

    return new Response("Offline - Konten tidak tersedia", {
      status: 503,
      statusText: "Service Unavailable",
      headers: new Headers({
        "Content-Type": "text/plain",
      }),
    });
  }
}

// Handle image requests
async function handleImageRequest(request) {
  try {
    // Try cache first
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }

    // Fetch from network
    const networkResponse = await fetch(request);

    // Cache images
    if (networkResponse && networkResponse.status === 200) {
      const cache = await caches.open(IMAGE_CACHE);
      cache.put(request, networkResponse.clone());
    }

    return networkResponse;
  } catch (error) {
    console.error("[Service Worker] Image fetch failed:", error);

    // Return placeholder image
    return new Response(
      '<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg"><rect width="200" height="200" fill="#e2e8f0"/><text x="50%" y="50%" text-anchor="middle" fill="#94a3b8" font-size="14">Offline</text></svg>',
      {
        headers: { "Content-Type": "image/svg+xml" },
      }
    );
  }
}

// Handle API requests
async function handleAPIRequest(request) {
  try {
    // Network first for API
    const networkResponse = await fetch(request);

    // Cache successful responses
    if (networkResponse && networkResponse.status === 200) {
      const cache = await caches.open(DYNAMIC_CACHE);
      cache.put(request, networkResponse.clone());
    }

    return networkResponse;
  } catch (error) {
    console.error("[Service Worker] API fetch failed:", error);

    // Try cache as fallback
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }

    return new Response(
      JSON.stringify({
        success: false,
        message: "Tidak ada koneksi internet",
      }),
      {
        status: 503,
        headers: { "Content-Type": "application/json" },
      }
    );
  }
}

// Background sync for offline form submissions
self.addEventListener("sync", (event) => {
  console.log("[Service Worker] Background sync:", event.tag);

  if (event.tag === "sync-pengaduan") {
    event.waitUntil(syncPengaduan());
  }
});

async function syncPengaduan() {
  // Get pending submissions from IndexedDB
  // Submit them when online
  console.log("[Service Worker] Syncing pengaduan...");
}

// Push notifications
self.addEventListener("push", (event) => {
  console.log("[Service Worker] Push received");

  const data = event.data ? event.data.json() : {};
  const title = data.title || "PDAM Muara Tirta";
  const options = {
    body: data.body || "Anda memiliki notifikasi baru",
    icon: "/backend/assets/images/logo/logo.png",
    badge: "/backend/assets/images/logo/logo.png",
    vibrate: [200, 100, 200],
    data: data.url || "/",
    actions: [
      {
        action: "open",
        title: "Buka",
      },
      {
        action: "close",
        title: "Tutup",
      },
    ],
  };

  event.waitUntil(self.registration.showNotification(title, options));
});

// Notification click
self.addEventListener("notificationclick", (event) => {
  event.notification.close();

  if (event.action === "open" || !event.action) {
    const urlToOpen = event.notification.data || "/";

    event.waitUntil(
      clients
        .matchAll({ type: "window", includeUncontrolled: true })
        .then((clientList) => {
          // Check if there's already a window open
          for (let client of clientList) {
            if (client.url === urlToOpen && "focus" in client) {
              return client.focus();
            }
          }

          // Open new window
          if (clients.openWindow) {
            return clients.openWindow(urlToOpen);
          }
        })
    );
  }
});

// Listen for skip waiting message
self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    console.log("[Service Worker] Skip waiting");
    self.skipWaiting();
  }
});

console.log("[Service Worker] Loaded", CACHE_VERSION);
