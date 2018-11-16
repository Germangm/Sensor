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
Asegúrate que después de la instalación, el Raspberry tenga la fecha y hora correcta, para evitar incongruencias en los datos recolectados, ya que el script toma el tiempo del sistema.

Abre la terminal del raspberry y empieza a configurarla con los siguientes comandos ![.](https://cdn-learn.adafruit.com/assets/assets/000/029/894/original/raspberry_pi_raspi-terminal.png?1453133507)

Escribe los siguientes comandos y dí que sí cuando se te pida (y) o (yes)

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get install nginx php-fpm hostapd isc-dhcp-server python3-serial

                                wget https://github.com/ShVerni/AirBeamLogger/archive/master.zip
                                unzip master.zip
                                cd AirBeamLogger-master
                                cp settings.json ~/settings.json
                                cp shutdown.sh ~/shutdown.sh
                                cp sync_time.sh ~/sync_time.sh
                                cp data_logger.py ~/data_logger.py
                                cd ..
                                chmod 755 data_logger.py sync_time.sh shutdown.sh
                                chmod 766 settings.json
