<style>
    form{ padding:10px; }
    label{ margin:10px; }
    input{ margin:10px; }
    button{ margin:10px; }
</style>
<?php

/**
 * Ödev ile ilgili gerekli geliştirmeyi form.php
 * içerisinde yapmanız gerekiyor.
 */

require "form2.php"; // form2.php varsa getir. yoksa hata ver

$postForm = Form::createPostForm("globals.php"); // static createPostForm fonksiyonu ile "globals.php" action değerli Form nesnesini oluştur ve $postForm'a ata
$getForm = Form::createGetForm("globals.php"); // static createGetForm fonksiyonu ile "globals.php" action değerli Form nesnesini oluştur ve $getForm'a ata
$lateForm = Form::createForm("globals.php", "POST","application/x-www-form-urlencoded"); // static createForm fonksiyonu ile "globals.php" action, "POST" method, "application/x-www-form-urlencoded" enctype değerleriyle Form nesnesini oluştur ve $lateForm'a ata
$fileForm = Form::createForm("globals.php", "POST","multipart/form-data"); // static createForm fonksiyonu ile "globals.php" action, "POST" method, "multipart/form-data" enctype değerleriyle Form nesnesini oluştur ve $lateForm'a ata

function itCreateForm(Form $form): Form {  // Form nesne tipine uygun olarak $form değerini al. işlem sonrası Form nesnesine uygun çıktı döndür
    $form->addField("Name", "name"); // $form nesnesinin fields property'sine addField ile "Name" ve "name" değerlerini ekle
    $form->addField("Surname", "surname"); // $form nesnesinin fields property'sine addField ile "Surname" ve "surname" değerlerini ekle
    $form->addField("Age", "age", 30); // $form nesnesinin fields property'sine addField ile "Age","age" ve 30 değerlerini ekle
    if($form->getEnctype() == "multipart/form-data") $form->addField("Profile", "profile", inputType: "file"); // form nesnesinin enctype değeri "multipart/form-data" ise file field'ını fields a ekle
    $form->addField("Degree", "degree", value: ["ba"=>"Bachelor","mba"=>"Master Bachelor","phd"=>"Doctoral"], inputType: "radio"); // $form nesnesinin fields property'sine addField ile "Degree","degree", value array, inputType="radio" değerlerini ekle
    $form->addField("Hobby", "hobby", value: ["bisiklet"=>"Bisiklet sürmek","resim"=>"Resim Çizmek","lego"=>"Lego"], inputType: "checkbox");// $form nesnesinin fields property'sine addField ile "Hobby","hobby", value array, inputType="checkbox" değerlerini ekle
    $form->addField("City", "city", value: ["34"=>"İstanbul","41"=>"Kocaeli","38"=>"Kayseri"], inputType: "select");// $form nesnesinin fields property'sine addField ile "City","city", value array, inputType="select" değerlerini ekle
    return $form; // $form nesnesini döndür
}

$postForm = itCreateForm($postForm); // $postForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle
$getForm = itCreateForm($getForm); // $getForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle
$lateForm = itCreateForm($lateForm); // $lateForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle
$fileForm = itCreateForm($fileForm); // $fileForm nesnesinin fields property'sine itCreateForm fonksiyonu ile yeni field değerleri ekle

$lateForm->setMethod("GET"); // $lateForm nesnesinin method property'sinin değerini "GET" değeri ile değiştir

$postForm->render(); // $postForm nesnesini, propertylerini kullanarak ekrana yazdır
echo "<hr>" . PHP_EOL; // <hr> tag ini yazıp alt satıra geç
$getForm->render(); // $getForm nesnesini, propertylerini kullanarak ekrana yazdır
echo "<hr>" . PHP_EOL; // <hr> tag ini yazıp alt satıra geç
$lateForm->render(); // $lateForm nesnesini, propertylerini kullanarak ekrana yazdır
echo "<hr>" . PHP_EOL; // <hr> tag ini yazıp alt satıra geç
$fileForm->render(); // $fileForm nesnesini, propertylerini kullanarak ekrana yazdır
