
<!-- LOGO -->
<p align="center">
  <img src="assets/img/logo.png" alt="Logo" width="80" height="80">
  <h3 align="center">Akeno Reader</h3>
  
  <p align="center">A web graphical interface for organizing and reading PDF files.</p>
  <!-- TO DO PROJECT SHIELDS -->
  <div align="center">
      <img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/lucasfrag/Akeno-Reader.svg?style=flat-square">  
      <img alt="GitHub issues" src="https://img.shields.io/github/issues-raw/lucasfrag/Akeno-Reader.svg?style=flat-square"> 
      <img alt="GitHub closed issues" src="https://img.shields.io/github/issues-closed-raw/lucasfrag/Akeno-Reader.svg?style=flat-square"> 
      <img alt="GitHub" src="https://img.shields.io/github/license/lucasfrag/Akeno-Reader.svg?style=flat-square">
  </div>
</p>

<!-- ABOUT THE PROJECT -->
## 📚 About The Project

Akeno Reader is a graphical interface for organizing and reading PDF files through the browser. 

### 🤔 The Problem...
The project was built to solve a personal problem. On my computer, I have several PDF files of mangas, e-books, articles, among others. I would like to have an environment where I can read these files and, at the same time, organize them.

### ...The Solution! 😍

A graphical interface for organizing and reading PDF files through the browser.

The system should be simple, without many technological complexities. 

The technologies would be limited to HTML, CSS and JavaScript for the front-end and just PHP on the back-end to meet some needs. This way, the project would easily run on any computer with [XAMPP](https://www.apachefriends.org/pt_br/index.html) or even [USBWebServer](https://usbwebserver.yura.mk.ua/).
And, as long as the PC is turned on, it can also be accessed on the local network by other devices such as a smartphone or tablet.

<b>NO DATABASE!</b> Instead, PHP will access a directory, read the folders, subfolders, and files, and create an interface based on them. This way, the user (me) would only worry about organizing the files within the directory instead of doing CRUDs for each new PDF. After finishing reading a file, simply mark it as read - this information will be saved in `files/read_status.txt`.

This way, I could separate entertainment content (such as manga) and study content (such as articles and technical books), and navigate between these libraries easily, quickly and intuitively.

## 📸 Screenshots


## 👉 Prerequisites 

- XAMPP, USBWebServer or a web server configured with PHP.

💬<i> I personally used NGINX with PHP on Windows.</i>


## ✅ Installation

1. Extract the contents to the folder of your web server.
2. Create a folder for your content in `files`, for example `Mangas` to compose the content type;
3. Inside the created folder, add a folder for the content, for example `Vagabond!` and place all your PDF files in this folder and also a file called `cover.jpg` to create the cover.

### Example

    .
    ├── ...
    ├── files                               
    │   ├── Mangas                        
    │   │   ├── Vagabond                 
    │   │       ├── cover.jpg
    │   │       ├── Chapter 01.pdf
    │   │       └── ...             
    │   ├── Samples                       
    │   │   ├── Berserk                 
    │   │   │    ├── cover.jpg
    │   │   │    ├── Sample 01.pdf
    │   │   │    └── ...
    │   │   ├── Yu-Gi-Oh!                 
    │   │   │    ├── cover.jpg
    │   │   │    ├── Sample 01.pdf
    │   │   │    └── ...    
    │   ├── read_status.txt                                        
    │   └── ...
    └── ...

4. If you want to assign specific icons in the navigation for each folder, go to `includes/content.php` and customize the switch case.
5. Enjoy!


## Built With
* [Argon Dashboard](https://demos.creative-tim.com/argon-dashboard/)
* [Bootstrap 4](https://getbootstrap.com)
* [PHP 7](https://php.net)
* [JQuery](https://jquery.com)

## Contributing
This is a personal project built for your own use. If you are interested, feel free to download it and customize it to your tastes and needs.
I will not accept contributions as that would mean adjusting the project to someone else's needs rather than mine.

## License
Distributed under the MIT License. See LICENSE for more information.

<!-- CONTACT -->
## Contact

Lucas Fraga - ti.lucasfraga@gmail.com

