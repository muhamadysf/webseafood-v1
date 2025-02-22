<script src="./node_modules/preline/dist/preline.js"></script>
<script src="./node_modules/lodash/lodash.min.js"></script>
<script src="./node_modules/dropzone/dist/dropzone-min.js"></script>
<script>
    function updateClock() {
        const now = new Date();

        // Format Jam, Menit, Detik
        let hours = now.getHours().toString().padStart(2, "0");
        let minutes = now.getMinutes().toString().padStart(2, "0");
        let seconds = now.getSeconds().toString().padStart(2, "0");

        document.getElementById("digital-clock").textContent = `${hours}:${minutes}:${seconds}`;

        // Format Hari, Tanggal, Bulan, Tahun
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        let dayName = days[now.getDay()];
        let day = now.getDate();
        let month = months[now.getMonth()];
        let year = now.getFullYear();

        document.getElementById("date-info").textContent = `${dayName}, ${day} ${month} ${year}`;
    }

    setInterval(updateClock, 1000);
    updateClock(); // Jalankan pertama kali agar tidak ada delay
</script>
</body>

</html>