#include <Keypad.h>                 // Sketsa ini menggunakan pustaka Keypad.h
#include <SPI.h>                    // Sketsa ini menggunakan pustaka SPI.h
#include <MFRC522.h>                // Sketsa ini menggunakan pustaka MFRC522.h

#define SS_PIN 10                   // Tentukan SS_PIN dari RC522 RFID Reader ke pin digital 10 dari Arduino
#define RST_PIN 9                   // Tentukan RST_PIN dari Pembaca RFID RC522 ke pin digital 9 dari Arduino
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Buat instance MFRC522.

int RedLed    = A0;                 // Output LED merah adalah pin analog A3
int GreenLed  = A1;                 // Output LED hijau adalah pin analog A4
int Buzzer    = A2;                 // Output Buzzer adalah pin analog A5
unsigned long Timer;                // Variabel untuk Timer



const byte ROWS = 4;                // Empat baris
const byte COLS = 3;                // Tiga kolom


char Keys[ROWS][COLS] = {           // Tentukan simbol-simbol pada tombol-tombol keypad
  {'1', '2', '3',},
  {'4', '5', '6',},
  {'7', '8', '9',},
  {'*', '0', '#',}
};

byte rowPins[ROWS] = {5, 4, 3, 2};  // Hubungkan ke pinouts baris keypad
byte colPins[COLS] = {8, 7, 6};     // Hubungkan ke pinouts kolom keypad
Keypad keypad = Keypad( makeKeymap(Keys), rowPins, colPins, ROWS, COLS); // Inisialisasi instance dari kelas NewKeypad

int RightCard;                      // Variabel untuk Kartu Mifare yang diketahui
int RightPinCode;                   // Variabel untuk input kunci yang valid dalam kombinasi dengan Kartu Mifare yang dikenal
int WrongPinCode;                   // Variabel untuk input kunci yang tidak valid dalam kombinasi dengan Kartu Mifare yang diketahui
int PinCodeCounter;                 // Variable Counter untuk menghitung jumlah input kode PIN pada keypad

int Code1Correct;                   // Variabel untuk input digit pertama yang benar (Kode) pada keypad
int Code2Correct;                   // Variable for the second correct digit (Code) input on the keypad
int Code3Correct;                   // Variable for the third correct digit (Code) input on the keypad
int Code4Correct;                   // Variable for the fourth correct digit (Code) input on the keypad
int Code5Correct;                   // Variable for the fifth correct digit (Code) input on the keypad
int Code6Correct;                   // Variable for the sixth correct digit (Code) input on the keypad
int Reset;                          // Setel ulang untuk pengulangan

int MifareCard1;                               // Kami membutuhkan variabel khusus ini untuk menentukan PinCode yang valid dalam kombinasi dengan UID nummer dari Kartu Mifare
const int Code1MifareCard1 = '2';              // Tentukan di sini digit pertama dari PIN 6 digit Anda
const int Code2MifareCard1 = '6';              // Determine here the second digit of your 6 digit PIN
const int Code3MifareCard1 = '0';              // Determine here the third digit of your 6 digit PIN
const int Code4MifareCard1 = '8';              // Determine here the fourth digit of your 6 digit PIN
const int Code5MifareCard1 = '9';              // Determine here the fifth digit of your 6 digit PIN
const int Code6MifareCard1 = '7';              // Determine here the sixth digit of your 6 digit PIN

int MifareCard2;                               // Kami membutuhkan variabel khusus ini untuk menentukan PinCode yang valid dalam kombinasi dengan UID nummer dari Kartu Mifare
const int Code1MifareCard2 = '0';              // Tentukan di sini digit pertama dari PIN 6 digit Anda
const int Code2MifareCard2 = '2';              // Determine here the second digit of your 6 digit PIN
const int Code3MifareCard2 = '1';              // Determine here the third digit of your 6 digit PIN
const int Code4MifareCard2 = '3';              // Determine here the fourth digit of your 6 digit PIN
const int Code5MifareCard2 = '9';              // Determine here the fifth digit of your 6 digit PIN
const int Code6MifareCard2 = '6';              // Determine here the sixth digit of your 6 digit PIN



//#include <SPI.h>
#include <UIPEthernet.h>

// Enter a MAC address for your controller below.
// Newer Ethernet shields have a MAC address printed on a sticker on the shield
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
// if you don't want to use DNS (and reduce your sketch size)
// use the numeric IP instead of the name for the server:
//IPAddress server(74,125,232,128);  // numeric IP for Google (no DNS)
char server[] = "192.168.1.4/webpayment/payment.php";    // Ganti dengan ip dari Web Server

// Set the static IP address to use if the DHCP fails to assign
IPAddress ip(192, 168, 0, 177); //Ganti ke IP dari ENC28J60

// Initialize the Ethernet client library
// with the IP address and port of the server
// that you want to connect to (port 80 is default for HTTP):
EthernetClient client;

int nomorRFID;
String data;

void setup() {
  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }

  SPI.begin();                                            // Initialize the SPI bus
  mfrc522.PCD_Init();                                     // Initialize the MFRC522
  pinMode (RedLed, OUTPUT);                               // Define RedLed as OUTPUT
  pinMode (GreenLed, OUTPUT);                             // Define GreenLed as OUTPUT
  pinMode (Buzzer, OUTPUT);                               // Define Buzzer as OUTPUT

  // start the Ethernet connection:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip);
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
  Serial.println("connecting...");

  // if you get a connection, report back via serial:
  //  if (client.connect(server, 80)) {
  //    Serial.println("connected");
  //    // Make a HTTP request:
  //    client.println("GET /search?q=arduino HTTP/1.1");
  //    client.println("Host: www.google.com");
  //    client.println("Connection: close");
  //    client.println();
  //  } else {
  //    // if you didn't get a connection to the server:
  //    Serial.println("connection failed");
  //  }
}

String inputString;
boolean isStringComplete = false;
boolean isStopRead = false;
//void serialEvent() {
//  while (mySerial.available()) {
//    // get the new byte:
//    char inChar = (char)mySerial.read();
//    // add it to the inputString:
//    inputString += inChar;
//    // if the incoming character is a newline, set a flag so the main loop can
//    // do something about it:
//    if (inChar == '@') {
//      stringComplete = true;
//    }
//  }
//}

void loop() {
  rfid(); //Aksi dari RFID

  //Jika ada response dari web
  // if there are incoming bytes available
  // from the server, read them and print them:
  if (client.available()) {
    isStopRead = true;
    char c = client.read();
    Serial.print(c);
    inputString += c;
  }

  // if the server's disconnected, stop the client:
  if (!client.connected()) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();
    isStringComplete = true;

    // do nothing forevermore:
    while (true);
  }

  //Jik ada response masuk yang sudah selesai dibentuk kedalam string
  if (isStringComplete) {
    Serial.println("Selamat Datang");
    Serial.print("Sisa saldo anda = ");                       // Cetak teks "Correct PinCode" ke monitor serial
    Serial.println(inputString);
    Reset = 1;                                              // Setel ulang pengulangan
    inputString = "";
    isStringComplete = false;
  }

}


//Kirim ke server menggunakan metode POST
void sendRequest() {
  Serial.println("Mengirim Request");
  if (client.connect(server, 80)) { // REPLACE WITH YOUR SERVER ADDRESS
    client.println("POST /add.php HTTP/1.1");
    client.print("Host: 192.168.1.4/webpayment/payment.php"); // SERVER ADDRESS HERE TOO
    client.println(server);
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    client.println(data.length());
    client.println();
    client.print(data);
  }

  delay(4000); //Delai pengiriman ke Web Server
}



void rfid() {
  if (Reset == 1)                                           // Jika Reset memiliki nilai 1 (HIGH) semua variabel akan direset ke 0 dan pembaca RFID RC522 akan menunggu Kartu Mifare baru.
  {
    RightCard = 0;
    MifareCard1 = 0;
    MifareCard2 = 0;
    RightPinCode = 0;
    WrongPinCode = 0;
    Code1Correct = 0;
    Code2Correct = 0;
    Code3Correct = 0;
    Code4Correct = 0;
    Code5Correct = 0;
    Code6Correct = 0;
    PinCodeCounter = 0;
    delay (50);
    Reset = 0;
  }


  //----------------------------------------------kode untuk kontrol untuk kode pin yang valid dalam batas waktu 7 detik setelah menampilkan / menawarkan Kartu Mifare yang valid ---------------------------


  if (millis() - Timer > 15000 && RightCard == 1)           // Jika Timer akan lebih besar dalam 7 detik dan Kartu Mifare yang valid ditawarkan, nilai reset akan tinggi.
  { // Ini berarti bahwa Anda memiliki kartu yang valid setelah menyajikan, 7 detik untuk memasukkan kode yang valid atau loop ulang.
    Reset = 1;
    Serial.println("CardAccesOff");
  }




  //----------------------------------------------Membaca Kartu Mifare yang disajikan / ditawarkan di MFRC522 -----------------------------------------------------------------------------------------


  if   (mfrc522.PICC_IsNewCardPresent() &&
        mfrc522.PICC_ReadCardSerial())
  {


    //----------------------------------------------Kode untuk mendeteksi Kartu Mifare pertama di Basis Data. Ini adalah nomor UID dengan 4 pasang digit. Contoh: 69 7C 01 9C------------------------------------
    if
    (mfrc522.uid.uidByte[0] == 0x32   &&                // Isi angka pertama dari nomor UID kartu Mifare Anda
        mfrc522.uid.uidByte[1] == 0xF5   &&                // Fill in the seconds digits of the UID number of your Mifare card
        mfrc522.uid.uidByte[2] == 0x3C   &&                // Fill in the third digits of the UID number of your Mifare card
        mfrc522.uid.uidByte[3] == 0x2F)                    // Fill in the fourth digits of the UID number of your Mifare card

    {
      isStopRead = false; //Menyetop mengirim ke server
//      nomorRFID = 1; //Memasukkan nomor rfid
      
      RightCard = 1;                                     // Kartu Mifare yang ditawarkan dikenal dalam database, atur variabel "RightCard" menjadi 1
      MifareCard1 = 1;                                   // Kartu Mifare ini dikenal sebagai Mifare Card 2 di Database, jadi tetapkan variabel MifareCard2 ke nilai 1.
      digitalWrite (Buzzer, HIGH);                       // Buat bunyi bip untuk Kartu Mifare yang diterima
      delay (150);                                       //
      digitalWrite (Buzzer, LOW);                        //

      PinCodeCounter = 0;                                // Setel ulang PinCodeCounter ke 0
      Timer =  millis();                                 // Setel ulang Timer. Batas 7 detik sedang berjalan sekarang untuk PinCode yang valid
      Serial.println("Selamat Datang SARTIKA LESTARI");
      Serial.println("Kartu di terima, silahkan masukkan password Anda");                 // Cetak teks "CardAccesOn" ke monitor serial
      delay (200);                                       // Tunggu 200 milidetik
    }


    //-----------------------------------------------Kode untuk mendeteksi Kartu Mifare kedua di Basis Data. Ini adalah nomor UID dengan 4 pasang digit. Contoh: EB 70 C0 BC----------------------------------------------
    if
    (mfrc522.uid.uidByte[0] == 0x32   &&                 // Isi angka pertama dari nomor UID kartu Mifare Anda
        mfrc522.uid.uidByte[1] == 0x09   &&                 // Fill in the seconds digits of the UID number of your Mifare card
        mfrc522.uid.uidByte[2] == 0xF3   &&                 // Fill in the third digits of the UID number of your Mifare card
        mfrc522.uid.uidByte[3] == 0x2F)                     // Fill in the fourth digits of the UID number of your Mifare card

    {
      isStopRead = false; //Menyetop mengirim ke server
//      nomorRFID = 2; //Memasukkan nomor RFID

      RightCard = 1;                                       // If the offered Mifare Card is known in the database, set variable "RightCard" to 1
      MifareCard2 = 1;
      digitalWrite (Buzzer, HIGH);                         // Make a beep for the accepted Mifare Card
      delay (150);                                         //
      digitalWrite (Buzzer, LOW);                          //

      PinCodeCounter = 0;                                  // Reset the PinCodeCounter to 0
      Timer =  millis();                                   // Reset the Timer. The 7 seconds limit is running now for a valid PinCode
      Serial.println("Selamat Datang IKE ARDIANTI TANJUNG");
      Serial.println("Kartu di terima, silahkan masukkan password Anda");                   // Print the text "CardAccesOn" to the serial monitor
      delay (200);                                         // Wait 200 milliseconds
    }

  }

  //-----------------------------------------------Kode untuk menerima MifareCard + PinCode valid yang valid-------------------------------------------------------------------------------------------------



  if (Code6Correct == 1 && RightCard == 1 && isStopRead == false)                    // Jika PinCode benar dan Anda memasukkan ini dalam 7 detik
  {
    RightPinCode = 1;                                       // Variabel RightPinCode akan diatur ke 1

    digitalWrite (GreenLed, HIGH);                          // Buat bunyi bip yang bagus untuk Pincode yang benar dan atur LED Hijau tinggi selama 1 detik
    delay (150);                                            //
    digitalWrite (Buzzer, HIGH);                            //
    delay (150);                                            //
    digitalWrite (Buzzer, LOW);                             //
    delay (50);                                             //
    digitalWrite (Buzzer, HIGH);                            //
    delay (150);                                            //
    digitalWrite (Buzzer, LOW);                             //
    delay (500);                                            //
    digitalWrite (GreenLed, LOW);                           //

    data = "nomorrfid=" + nomorRFID; //Nomor Id dari RFID yang akan dikirim
    sendRequest(); //Kirim Request ke Web
    //    Serial.println("Selamat Datang");
    //    Serial.println("Sisa saldo anda = L");                       // Cetak teks "Correct PinCode" ke monitor serial
    //    Reset = 1;                                              // Setel ulang pengulangan

  }

  //-----------------------------------------------Kode untuk menolak MifareCard yang valid + PinCode yang tidak valid------------------------------------------------------------------------------------------------



  if ((Code6Correct == 0) && (PinCodeCounter >= 6) && (RightCard == 1))       //Jika Anda menawarkan Kartu Mifare yang valid dan Pincode tidak benar dan Anda sudah memasukkan 6 kunci digit
  {
    WrongPinCode = 1;                                                       // Variable WrongPinCode akan diatur ke 1
    Serial.println("Salah kode");                                            // Cetak teks "WrongKey" ke monitor serial
    Reset = 1;                                                              // Setel ulang pengulangan
  }


  //-----------------------------------------------Kode untuk menolak PinCode Salah / Tidak Valid atau Timer (7 detik) kedaluwarsa----------------------------------------------------------------------------



  if ((WrongPinCode == 1) || (millis() - Timer > 7000 && RightCard == 1))     // Jika Anda menawarkan Kartu Mifare yang valid dan Anda memasukkan PinCode yang salah atau penghitung waktu (7 detik) berakhir
  {
    digitalWrite (Buzzer, HIGH);                                            // Buat bunyi bip panjang dan atur LED Merah TINGGI untuk kode yang salah atau waktu kedaluwarsa
    digitalWrite (RedLed, HIGH);                                            //
    delay(1500);                                                            //
    digitalWrite (Buzzer, LOW);                                             //
    digitalWrite (RedLed, LOW);                                             //

    Serial.println("Waktu Habis");                           // Cetak teks "WrongCode or Timer expired" ke monitor serial
    Reset = 1;                                                              // Setel ulang pengulangan
  }


  //-----------------------------------------------Kode untuk menghitung input pada keypad----------------------------------------------------------------------------------------------------------



  char KeyDigit = keypad.getKey();                                           // Dapatkan DigitKey dari keypad

  if ((RightCard == 1) &&                                                    // Jika Anda menawarkan Kartu Mifare yang valid dan DigitKey apa pun pada keypad ditekan
      ((KeyDigit == '1') ||
       (KeyDigit == '2')  ||
       (KeyDigit == '3')  ||
       (KeyDigit == '4')  ||
       (KeyDigit == '5')  ||
       (KeyDigit == '6')  ||
       (KeyDigit == '7')  ||
       (KeyDigit == '8')  ||
       (KeyDigit == '9')  ||
       (KeyDigit == '0')  ||
       (KeyDigit == '*')  ||
       (KeyDigit == '#')))

  {
    PinCodeCounter++;                                                       // PinCodeCounter memberi nilai +1 untuk setiap penekanan pada tombol Digit di keypad
    digitalWrite (Buzzer, HIGH);                                            // Buat bunyi bip pendek untuk menekan DigitKey pada keypad
    delay (50);                                                             //
    digitalWrite (Buzzer, LOW);                                             //
  }





  //-----------------------------------------------kode untuk menentukan PinCode yang benar untuk MifareCard1----------------------------------------------------------------------------------------------------------





  if ((KeyDigit == Code1MifareCard1) && (RightCard == 1) && (Code1Correct == 0) && (MifareCard1 == 1))           // If you offered the valid MifareCard1, first PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code1Correct = 1;                                                                                        // Variable Code1Correct is set to 1
    return;                                                                                                  // Return to begin loop
  }

  if ((KeyDigit == Code2MifareCard1) && (Code1Correct == 1) && (Code2Correct == 0) && (MifareCard1 == 1))        // If you offered the valid MifareCard1, second PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code2Correct = 1;                                                                                        // Variable Code2Correct is set to 1
    return;                                                                                                  // Return to begin loop
  }

  if ((KeyDigit == Code3MifareCard1) && (Code2Correct == 1) && (Code3Correct == 0) && (MifareCard1 == 1))         // If you offered the valid MifareCard1, third PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code3Correct = 1;                                                                                         // Variable Code3Correct is set to 1
    return;                                                                                                   // Return to begin loop
  }

  if ((KeyDigit == Code4MifareCard1) && (Code3Correct == 1) && (Code4Correct == 0) && (MifareCard1 == 1))         // If you offered the valid MifareCard1, fourth PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code4Correct = 1;                                                                                         // Variable Code4Correct is set to 1
    return;                                                                                                   // Return to begin loop
  }
  if ((KeyDigit == Code5MifareCard1) && (Code4Correct == 1) && (Code5Correct == 0) && (MifareCard1 == 1))         // If you offered the valid MifareCard1, fifth PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code5Correct = 1;                                                                                         // Variable Code5Correct is set to 1
    return;                                                                                                   // Return to begin loop
  }

  if ((KeyDigit == Code6MifareCard1) && (Code5Correct == 1) && (Code6Correct == 0) && (MifareCard1 == 1))         // If you offered the valid MifareCard1, sixth PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code6Correct = 1;                                                                                         // Variable Code6Correct is set to 1
    nomorRFID = 1; //Memasukkan nomor RFID
    return;                                                                                                   // Return to begin loop
  }




  //-----------------------------------------------Code for determine the correct PinCode for MifareCard2----------------------------------------------------------------------------------------------------------





  if ((KeyDigit == Code1MifareCard2) && (RightCard == 1) && (Code1Correct == 0) && (MifareCard2 == 1))              // If you offered a the valid MifareCard2, first PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code1Correct = 1;                                                                                           // Variable Code1Correct is set to 1
    return;                                                                                                     // Return to begin loop
  }

  if ((KeyDigit == Code2MifareCard2) && (Code1Correct == 1) && (Code2Correct == 0) && (MifareCard2 == 1))           // If you offered a the valid MifareCard2, second PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code2Correct = 1;                                                                                           // Variable Code2Correct is set to 1
    return;                                                                                                     // Return to begin loop
  }

  if ((KeyDigit == Code3MifareCard2) && (Code2Correct == 1) && (Code3Correct == 0) && (MifareCard2 == 1))           // If you offered a the valid MifareCard2, third PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code3Correct = 1;                                                                                           // Variable Code3Correct is set to 1
    return;                                                                                                     // Return to begin loop
  }

  if ((KeyDigit == Code4MifareCard2) && (Code3Correct == 1) && (Code4Correct == 0) && (MifareCard2 == 1))          // If you offered a the valid MifareCard2, fourth PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code4Correct = 1;                                                                                          // Variable Code4Correct is set to 1
    return;                                                                                                    // Return to begin loop
  }
  if ((KeyDigit == Code5MifareCard2) && (Code4Correct == 1) &&  (Code5Correct == 0) && (MifareCard2 == 1))         // If you offered a the valid MifareCard2, fifth PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code5Correct = 1;                                                                                          // Variable Code5Correct is set to 1
    return;                                                                                                    // Return to begin loop
  }

  if ((KeyDigit == Code6MifareCard2) && (Code5Correct == 1) &&  (Code6Correct == 0) && (MifareCard2 == 1))         // If you offered a the valid MifareCard2, sixth PinCode and you did not entered it before (Otherwise we conflict with same KeyDigits)
  {
    Code6Correct = 1;                                                                                          // Variable Code6Correct is set to 1
    nomorRFID = 2; //Memasukkan nomor RFID
    return;                                                                                                    // Return to begin loop
  }

}

