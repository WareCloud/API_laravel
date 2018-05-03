<?php

use Illuminate\Database\Seeder;

class SoftwaresTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $softwares = [[
            'name'          => 'Notepad++',
            'version'       => '7.5.10',
            'vendor'        => 'Notepad++',
            'vendor_url'    => 'https://notepad-plus-plus.org',
            'comment'       => 'Notepad++ is a free (as in "free speech" and also as in "free beer") source code editor and Notepad replacement that supports several languages. Running in the MS Windows environment, its use is governed by GPL License.',
            'download_url'  => 'https://notepad-plus-plus.org/repository/7.x/7.5.1/npp.7.5.1.Installer.exe',
            'icon_url'      => '/images/softwares/Notepad.png'
        ],
        [
            'name'          => 'Firefox',
            'version'       => '58.0',
            'vendor'        => 'Mozilla',
            'vendor_url'    => 'https://www.mozilla.org/firefox',
            'comment'       => 'Mozilla Firefox est un navigateur web libre et gratuit, développé et distribué par la Mozilla Foundation avec l\'aide de milliers de bénévoles grâce aux méthodes de développement du logiciel libre/open source et à la liberté du code source.',
            'download_url'  => 'https://stubdownloader.cdn.mozilla.net/builds/firefox-stub/fr/win/e7ea3ce59fac6d44b18980dd562df0d3c43bb95805d396fddb298da4c3603dc0/Firefox%20Installer.exe',
            'icon_url'      => '/images/softwares/Firefox.svg'
        ],
        [
            'name'          => 'Skype',
            'version'       => '7.40.0.104',
            'vendor'        => 'Microsoft',
            'vendor_url'    => 'https://www.skype.com',
            'comment'       => 'Skype est un logiciel qui permet aux utilisateurs de passer des appels téléphoniques ou vidéo via Internet, ainsi que le partage d\'écran.',
            'download_url'  => 'https://go.skype.com/classic.skype',
            'icon_url'      => '/images/softwares/Skype.svg'
        ],
        [
            'name'          => 'FileZilla',
            'version'       => '3.30',
            'vendor'        => 'Tim Kosse',
            'vendor_url'    => 'https://filezilla-project.org',
            'comment'       => 'FileZilla Client est un client FTP, FTPS et SFTP, développé sous la licence publique générale GNU. Il existe également un logiciel de serveur FTP du nom de FileZilla Server. Le logiciel est disponible pour Windows, Mac OS X et Linux.',
            'download_url'  => 'https://download.filezilla-project.org/client/FileZilla_3.30.0_win64-setup_bundled.exe',
            'icon_url'      => '/images/softwares/FileZilla.svg'
        ],
        [
            'name'          => '7-Zip',
            'version'       => '16.04',
            'vendor'        => 'Igor Pavlov',
            'vendor_url'    => 'http://www.7-zip.org',
            'comment'       => '7-Zip est un logiciel de compression de données et d’archivage de fichiers fonctionnant sous Windows développé par le Russe Igor Pavlov.',
            'download_url'  => 'http://www.7-zip.org/a/7z1604-x64.exe',
            'icon_url'      => '/images/softwares/7Zip.svg'
        ],
        [
            'name'          => 'TeamViewer',
            'version'       => '13.0.6447',
            'vendor'        => 'TeamViewer GmbH',
            'vendor_url'    => 'https://www.teamviewer.com',
            'comment'       => 'TeamViewer est un logiciel propriétaire de télémaintenance disposant de fonctions de bureau à distance, de téléadministration, de conférence en ligne et de transfert de fichiers.',
            'download_url'  => 'https://download.teamviewer.com/download/TeamViewer_Setup.exe',
            'icon_url'      => '/images/softwares/TeamViewer.svg'
        ],
        [
            'name'          => 'Dropbox',
            'version'       => '70.2.2',
            'vendor'        => 'Dropbox, Inc.',
            'vendor_url'    => 'https://www.dropbox.com',
            'comment'       => 'Dropbox est un service de stockage et de partage de copies de fichiers locaux en ligne proposé par Dropbox, Inc., entreprise localisée à San Francisco, en Californie.',
            'download_url'  => 'https://www.dropbox.com/download?os=win',
            'icon_url'      => '/images/softwares/Dropbox.svg'
        ],
        [
            'name'          => 'VLC',
            'version'       => '2.2.8',
            'vendor'        => 'VideoLAN',
            'vendor_url'    => 'https://www.videolan.org/vlc',
            'comment'       => 'VLC media player (VLC) (à l\'origine VideoLAN Client) est un lecteur multimédia libre issu du projet VideoLAN. Ce logiciel est multiplateforme puisqu\'il fonctionne sous Windows, toutes les tendances GNU/Linux, BSD, OS X, iOS, BeOS, Solaris, Android8, QNX et Pocket PC soit en tout près de 20 plates-formes. Il est distribué sous licence GNU GPL.',
            'download_url'  => 'https://get.videolan.org/vlc/3.0.1/win32/vlc-3.0.1-win32.exe',
            'icon_url'      => '/images/softwares/VLC.svg'
        ],
        [
            'name'          => 'Slack',
            'version'       => '3.0.5',
            'vendor'        => 'Slack Technologies',
            'vendor_url'    => 'https://slack.com',
            'comment'       => 'Slack est une plate-forme de communication collaborative propriétaire ainsi qu\'un logiciel de gestion de projets créé par Stewart Butterfield en août 2013 et officiellement lancée en février 2014.',
            'download_url'  => 'https://slack.com/ssb/download-win64',
            'icon_url'      => '/images/softwares/Slack.svg'
        ],
        [
            'name'          => 'Sublime Text',
            'version'       => '3.0',
            'vendor'        => 'Sublime HQ Pty Ltd',
            'vendor_url'    => 'https://www.sublimetext.com',
            'comment'       => 'Sublime Text est un éditeur de texte générique codé en C++ et Python, disponible sur Windows, Mac et Linux. Le logiciel a été conçu tout d\'abord comme une extension pour Vim, riche en fonctionnalités.',
            'download_url'  => 'https://download.sublimetext.com/Sublime%20Text%20Build%203143%20x64%20Setup.exe',
            'icon_url'      => '/images/softwares/SublimeText.svg'
        ],
        [
            'name'          => 'Google Chrome',
            'version'       => '64.0.3282.186',
            'vendor'        => 'Google',
            'vendor_url'    => 'https://www.google.com/chrome',
            'comment'       => 'Chrome est un navigateur web propriétaire développé par Google basé sur le projet libre Chromium fonctionnant sous Windows, Mac, Linux, Android et iOS.',
            'download_url'  => 'https://dl.google.com/tag/s/appguid%3D%7B8A69D345-D564-463C-AFF1-A69D9E530F96%7D%26iid%3D%7B8BCDC9DE-378B-437D-48C3-3836E73B6ACA%7D%26lang%3Dfr%26browser%3D4%26usagestats%3D0%26appname%3DGoogle%2520Chrome%26needsadmin%3Dprefers%26ap%3Dx64-stable-statsdef_1%26installdataindex%3Ddefaultbrowser/update2/installers/ChromeSetup.exe',
            'icon_url'      => '/images/softwares/GoogleChrome.svg'
        ]];

        foreach ($softwares as $software)
            DB::table('softwares')->insert($software);
    }
}
