<div class="flex items-center space-x-2">
    <input type="text" id="kode-produk" class="border p-1 w-full" value="{{ $kode_produk }}" readonly>
    <button type="button" onclick="copyText()" class="bg-blue-500 text-white px-3 py-1 rounded">
        Salin
    </button>
</div>

<script>
function copyText() {
    var copyText = document.getElementById("kode-produk");
    copyText.select();
    document.execCommand("copy");
    alert("Kode Produk berhasil disalin: " + copyText.value);
}
</script>