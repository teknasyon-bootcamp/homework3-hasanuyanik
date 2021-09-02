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
        private string $enctype = "application/x-www-form-urlencoded", // enctype private string olarak tanımla Construct ile değer al yoksa varsayılan ile devam et
    ){

    }

    static function createPostForm(string $action, string $enctype = "application/x-www-form-urlencoded"){ // action değerini al ve kullan, enctype değerini al yoksa varsayılan ile devam et
        return new static($action,"POST", enctype: $enctype); // çağrıldığı class'a göre construct ile alınan action değerini, method:POST değerini ve enctype değerini nesneye tanımla . nesneyi döndür
    }
    static function createGetForm(string $action, string $enctype = "application/x-www-form-urlencoded"){ // action değerini al ve kullan, enctype değerini al yoksa varsayılan ile devam et
        return new static($action,"GET", enctype: $enctype); // çağrıldığı class'a göre construct ile alınan action değerini, method:GET değerini ve enctype değerini nesneye tanımla . nesneyi döndür
    }
    static function createForm(string $action, string $method, string $enctype = "application/x-www-form-urlencoded"){ //action, method, enctype değerlerini al ve kullan. enctype değeri alınmadıysa varsayılan ile devam et
        return new static($action,$method,$enctype); // çağrıldığı class'a göre construct ile alınan action, method ve enctype değerlerini nesneye tanımla . nesneyi döndür
    }

    public function getAction(){ // action property'sini sınıf dışından çekmek için
        return $this->action;// action property değerini döndür
    }

    public function getMethod(){ // method property'sini sınıf dışından çekmek için
        return $this->method;// method property değerini döndür
    }

    public function getEnctype(){ // enctype property'sini sınıf dışından çekmek için
        return $this->enctype;// enctype property değerini döndür
    }

    public function setAction(string $action = ""){ // action property'sini sınıf dışından düzenlemek için değer gelirse değer ile gelmezse varsayılan değerle işleme devam et
        $this->action = $action;// nesnenin action property'sini $action değeri ile değiştir
    }

    public function setMethod(string $method = "POST"){ // method property'sini sınıf dışından düzenlemek için değer gelirse değer ile gelmezse varsayılan değerle işleme devam et
        $this->method = $method;// nesnenin method property'sini $method değeri ile değiştir
    }

    public function setEnctype(string $enctype = "application/x-www-form-urlencoded"){ // enctype property'sini sınıf dışından düzenlemek için değer gelirse değer ile gelmezse varsayılan değerle işleme devam et
        $this->enctype = $enctype;// nesnenin enctype property'sini $enctype değeri ile değiştir
    }

    public function addField(string $labelText, string $inputName, $value = null, string $placeholder = "...", string $inputType = "text"){ // labelText, inputName, value, placeholder, inputType değerlerini al, value, placeholder, inputType değerleri yoksa varsayılan değerleriyle devam et
        $field = [
            "inputType"=> $inputType, // input tipi text,textarea,file,select,radio,checkbox
            "labelText" => $labelText, // label da yazılacak değer
            "inputName" => $inputName, // input name="" değeri
            "value" => $value, // input value değer(leri)
            "placeholder" => $placeholder, // input içerisinde placeholder="" değeri
        ]; // field array'ini key=> value yapısıyla oluştur
        $this->fields[] = $field; // nesnenin fields property'sine $field array'ini ekle
    }

    public function render(){
        echo "<form method='$this->method' action='$this->action' enctype='$this->enctype'>"; // form tag'ine nesnenin method, action ve enctype değerlerini tanımla
        foreach ($this->fields as $field) { // nesnenin fields property'nin değerlerini field ile kullan
            $inputName = $field["inputName"]; // fields array'indeki inputName'i birçok yerde kullanabilmek için inputName değişkenine ata. çift tırnak bazı yerlerde yazmaya müsade etmiyor
            $inputType = $field["inputType"]; // fields array'indeki inputType'ı birçok yerde kullanabilmek için inputType değişkenine ata.
            $labelText = $field["labelText"]; // fields array'indeki labelText'i birçok yerde kullanabilmek için labelText değişkenine ata.
            $inputValue = $field["value"]; // fields array'indeki value değerini birçok yerde kullanabilmek için value değişkenine ata.
            $placeholder = $field["placeholder"]; // fields array'indeki placeholder'ı birçok yerde kullanabilmek için placeholder değişkenine ata.
            echo "<label for='$inputName'><b>$labelText</b></label>"; // label tag'ine inputName ve labelText değerlerini yazdır
            if($inputType == "select"){ // input tipi select ise
                echo "<select name='$inputName'>"; // select tag'ini aç, name değerine inputName'i tanımla ve ekrana yazdır
                foreach ($inputValue as $key=>$value){ // select için inputValue içinde bulunan değerleri foreach ile kullan
                    echo "<option value='$key'>$value</option>"; // option tag'inde key ve value değerlerini kullan ve ekrana yazdır
                }
                echo "</select>"; // select tag ini kapat
                continue 1; // $this->fields foreach 'indeki bu turu tamamladın sayıp devam et
            }elseif($inputType == "radio"){ // input tipi radio ise
                foreach ($inputValue as $key=>$value){  // radio için inputValue içinde bulunan değerleri foreach ile kullan
                    echo "<input type='$inputType' id='$key' name='$inputName' value='$value'>"; // input'ta inputType, key, inputName, value değerlerini kullan ve ekrana yazdır
                    echo "<label for='$key'>$value</label>"; // label ile key, value değerlerini kullan ve ekrana yazdır
                }
                continue 1; // $this->fields foreach 'indeki bu turu tamamladın sayıp devam et
            }elseif($inputType == "checkbox"){ // input tipi checkbox ise
                foreach ($inputValue as $key=>$value){  // checkbox için inputValue içinde bulunan değerleri foreach ile kullan
                    echo "<input type='$inputType' id='$key' name='$inputName-[]' value='$value'>"; // input'ta inputType, key, inputName, value değerlerini kullan ve ekrana yazdır. inputName ile -[] yazılmasının sebebi çoktan seçmeli işlemi için name değeri sonunda array gibi bu değeri barındırmalı
                    echo "<label for='$key'>$value</label>"; // label ile key, value değerlerini kullan ve ekrana yazdır
                }
                continue 1; // $this->fields foreach 'indeki bu turu tamamladın sayıp devam et
            }
            echo "<input type='$inputType' name='$inputName' value='$inputValue' placeholder='$placeholder'/>";  // input ile inputType, inputName, inputValue, placeholder değerlerini kullan ve ekrana yazdır

        }
        echo "<button type='submit'>Gönder</button>"; // formun en sonuna button yazdır
        echo "</form>"; // form tag'ini kapat
    }
}