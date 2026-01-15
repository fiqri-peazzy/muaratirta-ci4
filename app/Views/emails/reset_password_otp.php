<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password OTP</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7fa;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 40px 40px 30px; text-align: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px 16px 0 0;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">Reset Password</h1>
                            <p style="margin: 10px 0 0; color: #e6e9f0; font-size: 14px;">PERUMDA AIR MINUM MUARA TIRTA</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px; color: #2d3748; font-size: 16px; line-height: 1.6;">
                                Halo <strong><?= esc($name) ?></strong>,
                            </p>

                            <p style="margin: 0 0 30px; color: #4a5568; font-size: 15px; line-height: 1.6;">
                                Kami menerima permintaan untuk mereset password akun Anda. Gunakan kode OTP berikut untuk melanjutkan proses reset password:
                            </p>

                            <!-- OTP Box -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin: 0 0 30px;">
                                <tr>
                                    <td align="center" style="padding: 30px; background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%); border-radius: 12px; border: 2px dashed #cbd5e0;">
                                        <p style="margin: 0 0 10px; color: #718096; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Kode OTP Anda</p>
                                        <p style="margin: 0; color: #667eea; font-size: 48px; font-weight: 700; letter-spacing: 8px; font-family: 'Courier New', monospace;">
                                            <?= $otp ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Info Box -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin: 0 0 30px;">
                                <tr>
                                    <td style="padding: 20px; background-color: #fff3cd; border-left: 4px solid #ffc107; border-radius: 8px;">
                                        <p style="margin: 0; color: #856404; font-size: 14px; line-height: 1.6;">
                                            <strong>⏰ Penting:</strong> Kode OTP ini berlaku selama <strong>15 menit</strong> dan hanya dapat digunakan satu kali.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 20px; color: #4a5568; font-size: 15px; line-height: 1.6;">
                                Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman.
                            </p>

                            <!-- Button -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="<?= base_url('verify-otp') ?>" style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                                            Verifikasi OTP
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px 40px; background-color: #f7fafc; border-radius: 0 0 16px 16px; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0 0 10px; color: #718096; font-size: 13px; text-align: center;">
                                Email ini dikirim secara otomatis, mohon tidak membalas email ini.
                            </p>
                            <p style="margin: 0; color: #a0aec0; font-size: 12px; text-align: center;">
                                &copy; <?= date('Y') ?> PERUMDA AIR MINUM MUARA TIRTA. All Rights Reserved.
                            </p>
                        </td>
                    </tr>
                </table>

                <!-- Security Notice -->
                <table role="presentation" style="width: 600px; border-collapse: collapse; margin-top: 20px;">
                    <tr>
                        <td style="padding: 20px; text-align: center;">
                            <p style="margin: 0; color: #a0aec0; font-size: 12px; line-height: 1.6;">
                                🔒 Untuk keamanan akun Anda, jangan pernah membagikan kode OTP ini kepada siapapun, termasuk petugas kami.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>