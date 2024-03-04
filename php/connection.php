<?php

// connecting database

//$con = mysqli_connect('localhost', 'root', '', 'ngodb');
/*if (!$con) {
    die("Connection Not Found ");
}*/

//Donation Table

// $qry = "create table donation (id int primary key auto_increment, ufnm varchar(30),ulnm varchar(30),uemail varchar(30),uphno varchar(30),dtype varchar(10),dngo varchar(40),damount varchar(20),ddes varchar(300),uaddr varchar(10),uarea varchar(40),ulandmark varchar(100),upincode int,ucity varchar(50))";

// if (mysqli_query($con, $qry)) {
//     echo "Donation table created Successfully";
// } else {
//     echo "Error" . mysqli_error($con);
// }


// Users

// $qry = "create table users (id int primary key auto_increment, fnm varchar(30),lnm varchar(30),gen varchar(20),email varchar(30),phno varchar(30),pw varchar(50),bdate varchar(40),address varchar(200))";

// if (mysqli_query($con, $qry)) {
//     echo "User table created Successfully";
// } else {
//     echo "Error" . mysqli_error($con);
// }

// Contact us

// $qry = "create table contactUs (id int primary key auto_increment , nm varchar(30),em varchar(20),phno varchar(15),sub varchar(100),msg varchar(300))";
// if (mysqli_query($con, $qry)) {
//     echo "User table created Successfully";
// } else {
//     echo "Error" . mysqli_error($con);
// }


// Feedback 

// $qry = "create table feeback (id int primary key auto_increment , nm varchar(30),msg varchar(300))";
// if (mysqli_query($con, $qry)) {
//     echo "User table created Successfully";
// } else {
//     echo "Error" . mysqli_error($con);
// }

// Admins

// $qry = "create table admins (id int primary key auto_increment, fnm varchar(30),lnm varchar(30), gen varchar(10),email varchar(30),phno varchar(30),pw varchar(50),bdate varchar(20),address varchar(200))";

// if (mysqli_query($con, $qry)) {
//     echo "User table created Successfully";
// } else {
//     echo "Error" . mysqli_error($con);
// }

// NGOs

// $qry = "create table ngos (id int primary key auto_increment, nm varchar(30),founder varchar(300), vol varchar(10),establishadate varchar(30),phno varchar(30),em varchar(50),pw varchar(20),link varchar(100),upi varchar(20),address varchar(200),status varchar(20))";

// if (mysqli_query($con, $qry)) {
//     echo "User table created Successfully";
// } else {
//     echo "Error" . mysqli_error($con);
// }