<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Welcome to <?php echo general_setting('app_name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: Nunito, serif !important;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
        background-color: #f7f9fb;
        margin: 0;
        padding: 0;
      }
      .email-container {
        max-width: 600px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid <?php echo general_setting('app_theme_color'); ?>;
      }
      .header {
        background-color: <?php echo general_setting('app_theme_color'); ?>;
        color: #fff;
        text-align: center;
        padding: 20px;
      }
      .header h2 {
        margin: 0;
      }
      .content {
        padding: 25px;
        color: #333;
      }
      .content h3 {
        margin-top: 0;
        color: <?php echo general_setting('app_theme_color'); ?>;
      }
      .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
      }
      .details-table td {
        padding: 8px 10px;
        border: 1px solid #e1e1e1;
      }
      .details-table td:first-child {
        background-color: #f9f9f9;
        font-weight: bold;
        width: 35%;
      }
      .footer {
        text-align: center;
        background-color: #f2f4f6;
        padding: 15px;
        font-size: 13px;
        color: #777;
      }
      a.button {
        display: inline-block;
        padding: 10px 18px;
        background-color: <?php echo general_setting('app_theme_color'); ?>;
        color: #fff !important;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 15px;
      }
      @media only screen and (max-width: 600px) {
        .email-container {
          width: 100%;
          border-radius: 0;
        }
      }
    </style>
  </head>
  <body>
    <div class="email-container">
      <div class="header">
        <h2>Welcome to <?php echo general_setting('app_name'); ?>!</h2>
      </div>

      <div class="content">
        <h3>Hello <?php echo $customer_name; ?>,</h3>
        <p>We received a request to reset the password for your <?php echo general_setting('app_name'); ?> account. To reset your password, Please click the button below:</p>

        <p>
          <a href="<?php echo $href; ?>" class="button">Reset Password</a>
        </p>

        <p style="margin-top: 20px; font-size: 14px; color: #555;">
          If you didn’t create this account or believe this was sent by mistake,  
          please contact our support team immediately.
        </p>
      </div>

      <div class="footer">
        &copy; <?php echo date('Y'); ?> <?php echo general_setting('app_name'); ?>. All rights reserved.  
        <br>
        Need help? <a href="mailto:<?php echo general_setting('app_email'); ?>">Contact Support</a>
      </div>
    </div>
  </body>
</html>
