Germán García Martínez

A01281620

Contacto: garciamtz.german@gmail.com

### Cómo establecer comunicación de la Raspberry Pi con el Sensor de Contaminación 

Antes que nada se debe de tener instalado el sistema operativo Raspbian(GNU/Linux); en caso de no tenerlo, seguir los siguientes pasos:

#### Formatear una Tarjeta SD e Instalar NOOBS

Se debe de formatear la tarjeta SD de 8 GB o más como FAT. Para hacer esto, si usas Windows puedes uar la página https://www.sdcard.org/. 
Si usas OSX, vete a Disk Utility, selecciona la tarjeta, y elije Borrar con formato MS-DOS. 

El siguiente paso es descargar y extraer el .zip de NOOBS (New Out Of Box Software), el cual lo puedes conseguir a través del siguiente link http://downloads.raspberrypi.org/NOOBS_latest.
Copia los archivos extraidos a la SD que acabas de formatear, para que este en el directorio root de la tarjeta. 
La primera vez que inicies la Rasp, verás la siguiente pantalla, donde deberás escoger RASPBIAN, y seguir con el proceso de instalación.
![ pantalla](https://github.com/raspberrypi/noobs/blob/master/screenshots/os_installed.png)

#### Recolectar datos del sensor
Asegúrate que después de la instalación, el Raspberry tenga la fecha y hora correcta, para evitar incongruencias en los datos recolectados, ya que el script toma el tiempo del sistema. Prende el sensor por primera vez y conéctate con la apicación de AirCasting; selecciona "Mobile Session". Asegurase que recolecta datos, apaga y desconéctate de la app. Esto sólo debe de hacerse por única vez. Ahora conecta por medio de USB el sensor a la Raspberry.

Abre la terminal del raspberry y empieza a configurarla con los siguientes comandos ![.](https://cdn-learn.adafruit.com/assets/assets/000/029/894/original/raspberry_pi_raspi-terminal.png?1453133507)


Escribe los siguientes comandos y di que sí cuando se te pida (y) o (yes)

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get install nginx php-fpm hostapd isc-dhcp-server python3-serial
        wget https://github.com/Germangm/Sensor/archive/master.zip
        unzip master.zip
        cd Sensor-master
        cp settings.json ~/settings.json
        cp shutdown.sh ~/shutdown.sh
        cp sync_time.sh ~/sync_time.sh
        cp recolector.py ~/recolector.py
        cd ..
        chmod 755 recolector.py sync_time.sh shutdown.sh
        chmod 766 settings.json
        sudo /etc/init.d/nginx start
        
        
        sudo raspi-config (Network Options > N3 Network interface names > No y que Wlan0 sea el nombre)
        
Vuelve a abrir la terminal y escribe 
        
        sudo nano /etc/nginx/sites-enabled/default

Busca la linea que dice 
        
        index index.html index.htm index.nginx-debian.html;

Y agrega index.php, para que ahora sea 
        
        index index.php index.html index.htm index.nginx-debian.html;

Si la parte de index.nginx es diferente o no está, no prestes atención a ello, sólo agrega index.php

Ahora, tienes que hacer que descomentar algunas líneas del código, para que se vea así
        
        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
         location ~ \.php$ {
              include snippets/fastcgi-php.conf;

        #   	 # With php5-cgi alone:
        #        fastcgi_pass 127.0.0.1:9000;
        #        # With php7-fpm:
                 fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
         }

Guarda y cierra el archivo oprimiendo **ctrl + x**, y luego **Y**  para guardar.

Ahora escribe en la terminal

        sudo visudo
        
       
Y asegúrate de que se lea lo siguiente

        # User privilege specification
        root    ALL=(ALL:ALL) ALL
        www-data    ALL=(ALL:ALL) NOPASSWD: ALL
        
    
Nuevamente guarda y cierra el archivo oprimiendo **ctrl + x**, y luego **Y**  para guardar.
Ahora vuelve a abrir la terminal y escribe los siguientes comandos.
        
        sudo /etc/init.d/nginx reload
        sudo rm /var/www/html/index.nginx-debian.html
        sudo cp Sensor-master/html/* /var/www/html/
        sudo chown root:root /var/www/html/*
        sudo chmod 644 /var/www/html/*
        
        
Reinicia la Raspberry y escribe en la terminal
        
        hostname -i
        
Este último comando te dice la dirección IP de la Raspberry; introdúcelo al navegador web de la rasp y podrás empezar a recolectar los datos al oprimir "Empezar a tomar datos", los cuales se guardarán en un archivo .csv en la carpeta de Downloads cuando oprimas "Stop".

## Referencias

Raspberry Pi. (n.d.). Retrieved from documentation: https://www.raspberrypi.org/documentation/installation/noobs.md

Bitbucket (n.d.). Markdown syntax guide. Retrieved from https://confluence.atlassian.com/bitbucketserver/markdown-syntax-guide-776639995.html

Sam Groveman, J. Y. (n.d.). Airbeam2. Retrieved from http://www.takingspace.org/

Instructables (n.d.). Read and Write from Serial Port with Raspberry Pi. Retrieved from https://www.instructables.com/id/Read-and-write-from-serial-port-with-Raspberry-Pi/

eLinux (n.d.). RPi Serial Connection. Retrieved from https://elinux.org/RPi_Serial_Connection

w3Schools (2018) World's Largest web Developer Site; PHP5. Retrieved from https://www.w3schools.com/php/default.asp

