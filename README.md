# TBD

In this project our team built a **Remote Hosted Website** on a topic: **TBD -To Be Defined**, fashion and jewellery online shop. We implemented this richly-featured database-driven MVC web application with a server-side(*PHP*) and a client-side(*JavaScript/AJAX/CSS*), applied a Bootstrap front-end framework and a secure login system with sessions. We tracked changes to project using branching and merging in GIT and deployed final version to a remote server.

Click to see our last version [here!](http://google.com)

![Screenshot of the Product web page.](/assets/img/Capture2.jpg)

On this page:

* [Getting Started](#getting-started)
* [Prerequisites & Installing](#prerequisites-&-installing)
* [Running the tests](#running-the-tests)
* [Built With Technologies](#built-with-technologies)
* [More about using of a collaborative elements of GIT](#more-about-using-of-a-collaborative-elements-of-git)
* [More about MVC](#more-about-mvc)
* [AJAX in JavaScript](#ajax-in-javascript)
* [Versioning](#versioning)
* [Authors](#authors)
* [Acknowledgments](#acknowledgments)
* [Ideas to develop](#ideas-to-develop)

## Getting Started

You can get a copy of our project to a folder htdocs on your computer (usually C:\xampp\htdocs). Run the Modules: Apache and MYSQL under the XAMPP development environment. Import the database wp_ca4_tunjingAng_xingnuoCen.sql to MySQL module of a phpAdmin for testing/demo purposes. In the Netbeans open a project and navigate to folder: wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj in the htdocs folder. Run Project or press F6 to run.

### Prerequisites & Installing

To open our project you need to install Xampp, Netbeans or VS Code. How to install Xampp on Windows:
1.  Go to [Apache website](https://www.apachefriends.org/index.html)
1.  Choose Xampp for Windows 7.3.2
1.  Save installation pack on your computer and run when downloaded
1.  Follow the instructions and install in default folder: htdocs
1.  Tick all needed modules: Apache and MySql

To see instructions how to install Xampp on other machines [use this link!](https://www.apachefriends.org/download.html)

## Running the tests

To test the project:
1. Make sure Modules: Apache and MySql in Xampp are running
2. Go to your VS Code/Netbeans, open the project in your internet explorer for example: Chrome for Windows 10/8.1/8/7 (https://www.google.com/chrome/). 
3. View web pages, start from home, products details, use the form to register a new account/Reset Password -> then you could test creating of the order and checking user account details. On admin account you can view/manage/delete a Clients. Create/check orders for a Client on an account page, use Search feature

| Menu Item  | Description |
|     ---:    |      :---:      |
| Rainbow & Unicorn | Homepage  |
| Product  | Product list/categories page  |
| Login  | Secure login system/ Sign up/Forgot username/password |

## Built With Technologies

* [VS Code](https://code.visualstudio.com/download) - Source code editor
* [Xampp](https://www.apachefriends.org/index.html) - PHP development environment
* [Netbeans](https://netbeans.org/) - Open-source IDE
* [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript) - scripting, object orienteted language 
* [AJAX](https://www.tutorialspoint.com/ajax/what_is_ajax.htm) - Asynchronous JavaScript and XML
* [Bootstrap](https://getbootstrap.com/) - Open source toolkit for developing with HTML, CSS, and JS

## More about using of a collaborative elements of GIT
We are using a gitlab to keep track of any changes performed on a project repository by all of team members. We encourage you to use it too, if you working on a project within your team. Some examples of alternatives include: github or bitbucket. Belowe you can see some of the commands, which we used, while branching and merging in our git repository: 

| Command | Description |
| --- | --- |
| `git status` | List all *new or modified* files |
| `git checkout branch-name` | Create a **new** branch with *specific* name |
| `git branch -d branch-name` | Delete a branch with a **specified** name |
| `git checkout -b` | To create a new branch and switch into it in same time 
| 
## More about MVC
The Model View Controller architecture is often used in a web development to promote of the creation of tidy code with separated database interactions-Model from Controller-application control logic. Below is the example of function used for registering of a new Client:
```
<?php return function ($req, $res) {
    require_once 'models/Account.php';
    $args = [
        'username' => $req->body('username'),
        'email'   => $req->body('email'),
        'passcode' => $req->body('passcode')
    ];
    $form_posted = (!$args['username'] == null);
    if ($form_posted) {
        require_once 'models/Account.php';
        $success = false;
        if ($req->body('passcode') === $req->body('passcodeConfirm')) {
            $account = new Account($args);
            $success = $account->save();
        }
        if ($success) {
            $res->redirect('/');
        } else {
            $args['error'] = 'Username or Email had been used';
        }
    }
    $res->render('main', 'register_form', $args);
}
?>
```

## AJAX in JavaScript
Asynchronous JavaScript and XML AJAX is a new technique for creating more interactive web applications with the usage of XML, HTML, CSS, and Java Script. We used this effective feature for example in the Filter.js, see screenshot:

![Screenshot from the Filter.js:](/assets/img/Capture3.jpg)

## Versioning

We use GIT for versioning. For the versions available, see the tags on this repository.

## Authors

* **Tun Jing Ang**
* **Xingnuo Cen**
* **Emilia Czubaj**

See our project GIT repository [here!](https://gitlab.comp.dkit.ie/D00198874/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj)

## Acknowledgments

Inspirations/tutorials we followed while creating the project:
1.  2018/2019 Web Programming, tutorial's notes/examples
1.  https://www.youtube.com/watch?v=Ipa9xAs_nTg 
1.  https://www.w3schools.com/php/php_file_upload.asp 
1.  https://stackoverflow.com/questions/14069421/show-an-image-preview-before-upload
1.  https://readmetips.github.io/

## Ideas to develop

*  'Write a Review' option on a Product card
*  'Contact' web age/Google Maps feature
*  'Feedback' optionally for Clients
*  Using online gift cards feature
