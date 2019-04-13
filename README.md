# Dater
Dater, en basit tanımıyla, PHP için hazırlanmış bir tarih ve zaman sınıfıdır.
## Kurulumu
İki dosya ile birlikte gelmektedir: src, lang

 - **src:** İçerisinde Dater.php dosyası bulunur ve sınıfın kendisidir.
 - **lang:** Tarihlerde kullanılması için dil dosyaları bulunur.

Kurulumu gerçekleştirirken tek dikkat etmeniz gereken dil dosyalarının konumudur. Eğer sadece bir dil dosyasını indirerek Dater tarafından onun kullanılmasını istiyorsanız src/Dater.php dosyası içerisinde yer alan **$langFolder** değişkeninden klasörü belirtebilirsiniz. Eğer aynı dizinde ise tırnaklar arasını boş bırakabilirsiniz.
Dosyaları projenize kopyaladıktan sonra kullanmak istediğiniz dosyaya Dater.php sınıfını dahil edin.
## Giriş Ayarları
### Oluşturma
Anlık Tarihe Göre:

    $dater = new Dater();
Belirli Bir Tarihe Göre: 

    $dater = new Dater("2019-04-13 03:02:10");
### Saat Dilimi Belirleme
Oluştururken:

    $dater = new Dater("now", "Europe/Istanbul");
Oluşturduktan Sonra:
  
    $dater = new Dater();  
    $dater->setTimezone("Europe/Istanbul");
### Dil Belirleme
Şuan **Türkçe (tr), İngilizce (en) ve Fransızca (fr)** olarak kullanılabilir.
Oluştururken:

    $dater = new Dater("2019-04-13 03:02:10", "Europe/Istanbul", "tr");

Oluşturduktan Sonra:

    $dater = new Dater();  
    $dater->setLang('tr');
## Genel Metotlar
|Metot|Açıklaması|
| ------------ | ------------ |
|getInfo()|Aşağıda yer alan tüm get metotlarını içeren bir array döndürür.|
|getYear()|Dater'daki tarihe ait yılı döndürür.|
|getMon()|Dater'daki tarihe ait ayın sayısal gösterimini döndürür.|
|getMonth()|Dater'daki tarihe ait ayın metinsel gösterimini döndürür.|
|getMday()|Dater'daki tarihe ait ayın kaçıncı günü olduğunu döndürür.|
|getWday()|Dater'daki tarihe ait haftanın kaçıncı günü olduğunu döndürür.|
|getYday()|Dater'daki tarihe ait yılın kaçıncı günü olduğunu döndürür.|
|getWeekday()|Dater'daki tarihe ait günün metinsel gösterimini döndürür.|
|getHours()|Dater'daki tarihe ait saati döndürür.|
|getMinutes()|Dater'daki tarihe ait dakikayı döndürür.|
|getSeconds()|Dater'daki tarihe ait saniyeyi döndürür.|
|getTimestamp()|Dater'daki tarihe ait Timestamp'i döndürür.|

## Diğer Metotlar
### yesterday
 Belirtilen tarih ve saate göre 24 saat geri gider.

    $dater->yesterday()

---
### tomorrow
Belirtilen tarih ve saate göre 24 saat ileri gider.

    $dater->tomorrow()

---
### ago
 Tarih veya saat üzerinden geri gitmek için kullanılır. Geri gidilecek sayı ve tür belirlenir. Mutlaka bir sayı değeri almalıdır fakat eğer tür belirlenmezse gün varsayılan olarak kullanılır.

    $dater->ago(NUMBER, TYPE)

|Türler|Örnek|Açıklama|
| ------------ | ------------ | ------------ |
|years|$dater->ago(1, 'years')|1 yıl öncesi|
|months|$dater->ago(5, 'months')|5 ay öncesi|
|days|$dater->ago(7, 'days')|7 gün öncesi|
|hours|$dater->ago(2, 'hours')|2 saat öncesi|
|minutes|$dater->ago(45, 'minutes')|45 dakika öncesi|
|seconds|$dater->ago(10, 'seconds')|10 saniye öncesi|
---
### later
 Tarih veya saat üzerinden ileri gitmek için kullanılır. İleri gidilecek sayı ve tür belirlenir. Mutlaka bir sayı değeri almalıdır fakat eğer tür belirlenmezse gün varsayılan olarak kullanılır.

    $dater->later(NUMBER, TYPE)

|Türler|Örnek|Açıklama|
| ------------ | ------------ | ------------ |
|years|$dater->later(1, 'years')|1 yıl sonrası|
|months|$dater->later(5, 'months')|5 ay sonrası|
|days|$dater->later(7, 'days')|7 gün sonrası|
|hours|$dater->later(2, 'hours')|2 saat sonrası|
|minutes|$dater->later(45, 'minutes')|45 dakika sonrası|
|seconds|$dater->later(10, 'seconds')|10 saniye sonrası|
---
### firstDay
Belirtilen tarihin içinde bulunduğu ayın ilk gününe gider.

    $dater->firstDay()

---
### lastDay
Belirtilen tarihin içinde bulunduğu ayın son gününe gider.

    $dater->lastDay()

---
### between
Belirtilen iki tarih arasındaki günleri döndürür.

    $dater->between(FIRST_DAY, LAST_DAY);

## Metotların Çıktıları
Çıktılarımızdan önce yapımızı oluşturalım:

    $dater = new Dater('2019-04-13 03:18:12', 'Europe/Istanbul', 'tr');
---
### yesterday
Yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $yesterday = $dater->yesterday();  
    print_r($yesterday->getWeekday());
**Çıktısı:** Cuma

---
### tomorrow
Yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $tomorrow= $dater->tomorrow();  
    print_r($tomorrow->getWeekday());
**Çıktısı:** Pazar

---
### ago
Yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $ago2days = $dater->ago(2);  
    print_r($ago2days->getWeekday());

**Çıktısı:** Perşembe

---
### later
Yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $later3months = $dater->later(3, 'months'); // Temmuz
    print_r($later3months ->getWeekday()); // 13 Temmuz 2019 Hangi Gün?
**Çıktısı:** Cumartesi

---
### firstDay
Yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $firstDay = $dater->firstDay();
    print_r($firstDay->getWeekday()); // 1 Nisan 2019 Hangi Gün?

**Çıktısı:** Pazartesi

---
### lastDay
Yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $lastDay = $dater->lastDay();  
    print_r($lastDay->getMday()); // Bu Ay Kaç Çekiyor?

**Çıktısı:** 30

---
### between
Bir array geri döndürür. Dizinin totalDay hariç tüm elemanları yeni bir Dater sınıfı oluşturur ve onu döndürür.

    $between = $dater->between($dater->ago(2), $dater->later(1));  
    print_r($between);

**Çıktısı:**

    [
		totalDay = 3,
		firstDay = {Aralığın ilk günü - Dater Object - 11 Nisan 2019},
		lastDay = {Aralığın son günü - Dater Object - 14 Nisan 2019},
		datesBetween = {
			{Dater Object - 12 Nisan 2019},
			{Dater Object - 13 Nisan 2019},
		}
	]

