# Authentication


In order to authentify yourself on the application, you need to visit this [website](https://google.fr). This generates a QRCode that contains a token that expires after 24 hours.

<aside class="notice">
  You can only login with a QRCode
</aside>

Once you have obtained a QRCode, scan it with the application.

![image 1](images/login.png)

If the token is valid you should be authentified and redirected to the application's home.

If not, a red banner saying **USER NOT FOUND** will appear briefly. If that happens, just go back to [https://google.fr](https://google.fr) and regenerate a QRCode.

![image 2](images/login-error.png)