
    function chatAdmin() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Halo Admin Altratex, Saya mau tanya tentang kain {{ urlencode($product->nama_produk) }} {{ urlencode($firstLebar) }}/{{ urlencode($firstGramasi) }} yang ada di website. Berikut link produknya: ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282223518887?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
function mintaSample() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Halo Admin Altratex, Saya mau minta sample kain {{ urlencode($product->nama_produk) }} {{ urlencode($firstLebar) }}/{{ urlencode($firstGramasi) }} yang ada di website. Berikut link produknya : ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282223518887?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
function shareWhatsapp() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Bahan Kaos {{ urlencode($product->nama_produk) }} {{ urlencode($firstLebar) }}/{{ urlencode($firstGramasi) }} dari Altratex Group. Berikut link produknya : ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282223518887?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
function checkoutWhatsapp() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Halo Admin Altratex, Saya mau beli kain {{ urlencode($product->nama_produk) }} {{ urlencode($firstLebar) }}/{{ urlencode($firstGramasi) }} yang ada di website. Berikut link produknya: ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282223518887?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}

