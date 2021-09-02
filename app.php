<?php

/**
 * Ödev ile ilgili gerekli geliştirmeyi form.php
 * içerisinde yapmanız gerekiyor.
 */

require "form.php"; // form.php varsa getir. yoksa hata ver

$postForm = Form::createPostForm("globals.php"); // static createPostForm fonksiyonu ile "globals.php" action değerli Form nesnesini oluştur ve $postForm'a ata
$getForm = Form::createGetForm("globals.php"); // static createGetForm fonksiyonu ile "globals.php" action değerli Form nesnesini oluştur ve $getForm'a ata
$lateForm = Form::createForm("globals.php", "POST"); // static createForm fonksiyonu ile "globals.php" action ve "POST" method değerleriyle Form nesnesini oluştur ve $lateForm'a ata

function itCreateForm(Form $form): Form { // Form nesne tipine uygun olarak $form değerini al. işlem sonrası Form nesnesine uygun çıktı döndür
    $form->addField("Name", "name"); // $form nesnesinin fields property'sine addField ile "Name" ve "name" değerlerini ekle
    $form->addField("Surname", "surname"); // $form nesnesinin fields property'sine addField ile "Surname" ve "surname" değerlerini ekle
    $form->addField("Age", "age", 30); // $form nesnesinin fields property'sine addField ile "Age","age" ve 30 değerlerini ekle
    return $form; // $form nesnesini döndür
}

$postForm = itCreateForm($postForm); // $postForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle
$getForm = itCreateForm($getForm); // $getForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle
$lateForm = itCreateForm($lateForm); // $lateForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle

$lateForm->setMethod("GET"); // $lateForm nesnesinin method property'sinin değerini "GET" değeri ile değiştir

$postForm->render(); // $postForm nesnesini, propertylerini kullanarak ekrana yazdır
echo "<hr>" . PHP_EOL; // <hr> tag ini yazıp alt satıra geç
$getForm->render(); // $getForm nesnesini, propertylerini kullanarak ekrana yazdır
echo "<hr>" . PHP_EOL; // <hr> tag ini yazıp alt satıra geç
$lateForm->render(); // $lateForm nesnesini, propertylerini kullanarak ekrana yazdır
