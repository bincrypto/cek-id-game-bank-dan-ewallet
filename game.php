<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Cek Nickname Game</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-6 sm:p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
      🔍 Cek Nickname Game / Ewallet
    </h2>

    <form id="cekForm" class="space-y-4">
      <!-- User ID -->
      <div>
        <label class="block text-sm font-medium text-gray-700">User ID / Nomor Ewallet / Nomor Rekening</label>
        <input type="text" name="user_id" required
          class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none p-2">
      </div>

      <!-- Zone ID -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Zone ID (opsional)</label>
        <input type="text" name="zone_id"
          class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none p-2">
      </div>

      <!-- Select Game / Ewallet -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Pilih Game / Ewallet</label>
        <select name="code" required
          class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none p-2">
          <option value="">-- Pilih --</option>
          <optgroup label="🎮 Games">
            <option value="Mobile Legends">Mobile Legends</option>
            <option value="Free Fire">Free Fire</option>
            <option value="Honor of Kings">Honor of Kings</option>
            <option value="Call of Duty">Call of Duty</option>
            <option value="PUBG Mobile">PUBG Mobile</option>
             <option value="Blood Strike">Blood Strike</option>
          </optgroup>
          <optgroup label="💳 Ewallet">
            <option value="DANA">DANA</option>
            <option value="OVO">OVO</option>
            <option value="GOPAY">GOPAY</option>
            <option value="SHOPEEPAY">ShopeePay</option>
            <option value="LINKAJA">LINKAJA</option>
          </optgroup>
          <optgroup label="🏦 Bank">
            <option value="008">Bank Mandiri</option>
            <option value="002">Bank BRI</option>
            <option value="009">Bank BNI</option>
            <option value="014">Bank BCA</option>
            <option value="011">Bank Danamon</option>
            <option value="013">Bank Permata</option>
            <option value="451">Bank BSI</option>
            <option value="016">Maybank Indonesia</option>
          </optgroup>
        </select>
      </div>

      <!-- Button -->
      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
        🚀 Cek ID
      </button>
    </form>

    <!-- Result -->
    <div id="result" class="hidden mt-6 p-4 rounded-lg border text-sm"></div>
  </div>

  <script>
    document.getElementById('cekForm').addEventListener('submit', async function (e) {
      e.preventDefault();

      let formData = new FormData(this);
      let response = await fetch('check.php', { method: 'POST', body: formData });
      let data = await response.json();

      let resultDiv = document.getElementById('result');
      resultDiv.classList.remove('hidden');

      if (data.status === true) {
        resultDiv.className = "mt-6 p-4 rounded-lg border bg-green-50 text-green-800 text-sm";
        resultDiv.innerHTML = `
          <p class="font-semibold">Hasil</p>
          <p><b>Game:</b> ${data.data.game}</p>
          <p><b>User ID:</b> ${data.data.user_id}</p>
          <p><b>Zone ID:</b> ${data.data.zone_id ?? '-'}</p>
          <p><b>Username:</b> ${data.data.username}</p>
          <p><b>Message:</b> ${data.message}</p>
        `;
      } else {
        resultDiv.className = "mt-6 p-4 rounded-lg border bg-red-50 text-red-800 text-sm";
        resultDiv.innerHTML = `
          <p class="font-semibold">Gagal</p>
          <p>${data.message || 'Tidak ada respon'}</p>
        `;
      }
    });
  </script>
</body>

</html>