# CSV Toolkit

CSV dosyalarını tarayıcıda açan, inceleyen ve yeniden dışa aktaran tek dosyalık araç.
Sütun seçimi, arama, sıralama, yinelenen/boş satır işaretleme ve formül enjeksiyonu
azaltması içerir. Dosya sunucuya yüklenmez.

- Dosya: `csvtoolkit.php` (tek dosya, ~64 KB)
- Çalıştığı yer: tarayıcı (istemci tarafı)
- Sunucu tarafı kod: yok

## Amaç

Bir CSV dosyasının içeriğini hızlıca görmek, temizlemek ve filtrelenmiş hâlini CSV veya
JSON olarak indirmek; bunu yaparken veriyi bir sunucuya göndermemek.

## Özellikler

- Ayraç: otomatik algılama, virgül (`,`), noktalı virgül (`;`), sekme, dikey çizgi (`|`).
- Tırnaklı alanlar, kaçırılmış tırnaklar (`""`) ve alan içindeki satır sonları desteklenir.
- UTF-8 BOM otomatik kaldırılır.
- Sütuna göre sıralama (artan/azalan) ve "sıralama yok" durumu.
- Metin araması ve sonuçların filtrelenmesi.
- Yinelenen satırları işaretleme; yalnızca yinelenenleri gösterme.
- Boş satırları işaretleme ve kaldırma.
- Görünen satır sayısı, sütun sayısı ve dosya boyutu göstergeleri.
- Dışa aktarma: **CSV indir**, **JSON indir**.
- Formül enjeksiyonu azaltması: `=`, `+`, `-`, `@` ile başlayan hücreler dışa aktarımda
  varsayılan olarak apostrofla etkisizleştirilir; koruma kapatılırsa durum metni bunu bildirir.
- 300 satırlık görünüm penceresi; sayfa kendi içinde kaymaz, tablo kaydırılır.

## Ekran görüntüsü

Bu depoda ekran görüntüsü **yoktur**; uydurma görsel eklenmemiştir. Kendi görüntünüzü
1440 px ve 390 px genişlikte, gerçek bir CSV yüklüyken alın ve tarayıcı sürümünü yazın.

## Gereksinimler

- Güncel Chrome, Edge, Firefox veya Safari.
- `File`, `Blob`, `TextDecoder`, `URL.createObjectURL` desteği.
- JavaScript açık olmalıdır.
- Ağ bağlantısı gerekmez; CDN, harici font veya uzak kütüphane yoktur.

## Çalıştırma

```powershell
python -m http.server 8000
# veya
php -S 127.0.0.1:8000
```

`http://127.0.0.1:8000/csvtoolkit.php` adresini açın. `file://` üzerinden de çalışır.

## Kullanım

1. "Dosya seç" ile bir `.csv` dosyası seçin (sürükle-bırak desteklenir).
2. Gerekirse ayracı elle değiştirin; otomatik algılama çoğu dosyada yeterlidir.
3. Sütun seçip sıralayın, arama alanıyla filtreleyin.
4. Yinelenen ve boş satırları işaretleyip gereksizleri kaldırın.
5. "CSV indir" veya "JSON indir" ile sonucu indirin.

Sayfa yenilendiğinde dosya ve türetilmiş veriler kaybolur.

## Teknik ayrıntılar

- CSV ayrıştırıcı durum makinesiyle yazılmıştır: tırnak içi/ dışı, kaçırılmış tırnak,
  gömülü satır sonu ve boş hücre durumlarını yönetir.
- Ayraç algılama ilk satırlardaki tutarlılığa bakar; yanlış sonuç verirse kullanıcı
  ayraç seçimini değiştirebilir.
- Bellek sınırları **ayrıştırmadan önce** uygulanır: dosya boyutu, satır ve sütun sayısı
  kontrol edilir; aşım durumunda ayrıştırma başlamaz.
- Hücreler DOM'a `textContent` ile yazılır; CSV içindeki `<script>` etiketi HTML olarak
  yorumlanmaz, düz metin görünür.
- Sıralama ve filtreleme saf fonksiyonlarla yapılır (`filterRows`, `sortRows`,
  `findDuplicateRows`, `toCsv`, `toJson`), arayüzden bağımsız test edilebilir.
- Dışa aktarılan CSV, RFC 4180 tarzı tırnaklama ve `\r\n` satır sonu kullanır.

## Sınırlar ve güvenlik

| Sınır | Değer |
| --- | --- |
| Dosya boyutu | 5 MB |
| Satır | 20.000 |
| Sütun | 120 |
| Görünen satır (pencere) | 300 |

- Sınır aşılırsa işlem yapılmaz ve neden bildirilir.
- Ağ isteği yoktur; dosya `File` API'siyle yerel olarak okunur.
- Formül enjeksiyonu azaltması Excel/LibreOffice için tasarlanmıştır; tüm elektronik
  tablo yazılımlarının davranışı garanti edilmez.
- Hücre içeriği hiçbir zaman HTML veya formül olarak çalıştırılmaz.
- Bellek kullanımı dosya boyutuyla sınırlıdır; tarayıcı başına farklılık gösterebilir.

## Lisans

- Bu proje için **henüz bir lisans seçilmemiştir**; bu depoda `LICENSE` dosyası yoktur.
  Yayına almadan önce sahibinin lisans seçip eklemesi gerekir. Bu README lisans vaadi değildir.
- Üçüncü taraf kod yoktur.

## Test edilenler

2026-10-28, Edge/Chromium 156 ve PHP 8.3.36 ile:

- Dosya portfolyo dışındaki geçici bir klasörden servis edildi: `HTTP 200`, tek `<h1>`,
  harici kaynak yok, konsol hatası yok.
- `parseCsv` tırnaklı alanı (`"a;b"`) tek hücre olarak, boş satırı boş satır olarak okudu.
- `formulaRisk('=1+1')` doğru sonuç verdi; `csvEscape` virgüllü değeri tırnakladı.
- Arayüz üzerinden gerçek CSV yüklendi: 3 satır, `Satır / ad / soyad / not` başlıkları.
- `<script>alert(1)</script>` hücresi HTML olarak çalışmadı; `document.body.innerHTML`
  içinde ham `<script>` etiketi oluşmadı.
- 1440 px ve 390 px genişlikte sayfa taşması yok; tablo kendi içinde kaydı.

## Test edilmeyenler ve bilinen sınırlar

- Firefox ve Safari'de gerçek tarayıcı testi yapılmadı.
- Gerçek mobil cihaz ve ekran okuyucu testi yapılmadı.
- 5 MB / 20.000 satır üst sınırında performans ölçülmedi.
- Yalnızca UTF-8 varsayılır; UTF-16 veya eski kod sayfaları (ISO-8859-9, Windows-1254)
  otomatik algılanmaz ve bozuk görünebilir.
- Alan içi satır sonları tablo görünümünde tek satırda gösterilir; hücre düzenleme yoktur.
- Formül azaltması dışa aktarımda uygulanır; ekrandaki değer değiştirilmez.

## Ayrı GitHub deposu olarak yayınlama

1. Bu klasörü yeni depoya kopyalayın.
2. GitHub Pages için dosyayı **`index.html`** olarak yeniden adlandırın.
3. Pages → "Deploy from a branch" → `main` / `root`.
4. Yayın sonrası gerçek bir CSV dosyasıyla ayrıştırma, sıralama ve indirmeyi doğrulayın.
5. Lisans seçip `LICENSE` ekleyin; gerçek ekran görüntüsü ekleyin.
