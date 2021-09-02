<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */

class Form
{
    private $fields; // fields private olarak tanımla

    private function __construct(
        private string $action, // action private string olarak tanımla Construct ile değer al
        private string $method, // method private string olarak tanımla Construct ile değer al
    ){

    }

    static function createPostForm(string $action){ // action değerini al ve kullan
        return new static($action,"POST"); // çağrıldığı class'a göre construct ile alınan action değerini ve method:POST değerini nesneye tanımla . nesneyi döndür
    }
    static function createGetForm(string $action){ // action değerini al ve kullan
        return new static($action,"GET"); // çağrıldığı class'a göre construct ile alınan action değerini ve method:GET değerini nesneye tanımla . nesneyi döndür
    }
    static function createForm(string $action, string $method){ //action ve method değerlerini al ve kullan
        return new static($action,$method); // çağrıldığı class'a göre construct ile alınan action ve method değerlerini nesneye tanımla . nesneyi döndür
    }

    public function addField(string $labelText, string $inputName, $value = null){ // labelText, inputName, value değerlerini al, ama value değeri verilmese bile varsayılan değer "null" ile devam et
        $field = [$labelText,$inputName,$value]; // field array'ini labelText,inputName ve value değerleriyle oluştur
        $this->fields[] = $field; // nesnenin fields property'sine $field array'ini ekle
    }

    public function setMethod(string $method = "POST"){ // method değeri verildiyse al yoksa varsayılan değer ile devam et
        $this->method = $method; // nesnenin method property'sini $method değeri ile değiştir
    }

    public function render(){
        echo "<form method='$this->method' action='$this->action'>"; // form tag'ine nesnenin method ve action değerlerini tanımla
        foreach ($this->fields as $field) { // nesnenin fields property'nin değerlerini field ile kullan
            echo "<label for='$field[1]'>$field[0]</label>"; // label tag'ine field array'inden "field[1]"inputName ve "field[0]"labelText değerlerini yazdır
            echo "<input type='text' name='$field[1]' value='$field[2]' />"; // input'a field array'inden "field[1]"inputName ve "field[2]"inputValue değerlerini yazdır
        }
        echo "<button type='submit'>Gönder</button>"; // formun en sonuna button yazdır
        echo "</form>"; // form tag'ini kapat
    }
}