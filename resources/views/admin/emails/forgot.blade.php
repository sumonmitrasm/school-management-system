<table style="width: 100%; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
  <tr>
    <td align="center">
      <table style="width: 600px; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <tr>
          <td style="text-align: center; padding: 10px 0;">
            <h2 style="margin: 0; color: #333333;">Hello {{$user->name}},</h2>
          </td>
        </tr>
        <tr>
          <td style="padding: 20px 0; text-align: left; color: #555555; line-height: 1.6;">
            <p style="margin: 0;">We received a request to reset your password. Please click the button below to reset your password:</p>
          </td>
        </tr>
        <tr>
          <td style="text-align: center; padding: 20px 0;">
            <a href="{{ url('reset/' . $user->remember_token) }}" 
               style="text-decoration: none; display: inline-block; background-color: #007bff; color: #ffffff; padding: 10px 20px; border-radius: 4px; font-weight: bold;">
              Reset Your Password
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding: 20px 0; text-align: left; color: #555555; line-height: 1.6;">
            <p style="margin: 0;">If you did not request this change, please ignore this email. No changes will be made to your account.</p>
          </td>
        </tr>
        <tr>
          <td style="padding: 10px 0; text-align: left; color: #555555; line-height: 1.6;">
            <p style="margin: 0;">Thanks,<br>{{ config('app.name') }}</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
