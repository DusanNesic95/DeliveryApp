cordova build --release android

keytool -genkey -v -keystore my-release-key.keystore -alias alias_name -keyalg RSA -keysize 2048 -validity 10000

jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore my-release-key.keystore "C:\Users\Dusan Nesic\Documents\DeliveryApp\platforms\android\build\outputs\apk\android-release-unsigned.apk" alias_name

cd "C:\Users\Dusan Nesic\AppData\Local\Android\android-sdk\build-tools\24.0.1"

.\zipalign.exe -v 4 "C:\Users\Dusan Nesic\Documents\DeliveryApp\platforms\android\build\outputs\apk\android-release-unsigned.apk" "C:\Users\Dusan Nesic\Documents\DeliveryApp\platforms\android\build\outputs\apk\DeliveryApp.apk"

pass: dn2104995