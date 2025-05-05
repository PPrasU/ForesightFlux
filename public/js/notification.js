// notification.js
function addNotification(iconClass, bgColor, title, text) {
    let notificationList = document.getElementById("notification-list");
    let notificationCount = document.getElementById("notification-count");

    // Cek kalau elemen ada supaya gak error
    if (!notificationList || !notificationCount) {
        console.error("Notification elements not found!");
        return;
    }

    // Membuat elemen notifikasi baru
    let newNotification = document.createElement("a");
    newNotification.href = "javascript:void(0);";
    newNotification.classList.add(
        "dropdown-item",
        "notify-item",
        "active",
        "notification-fade-in"
    ); // Tambah animasi

    // Mengatur ikon dan warna background
    newNotification.innerHTML = `
        <div class="notify-icon bg-${bgColor}">
            <i class="mdi ${iconClass}"></i>
        </div>
        <p class="notify-details">${title}<span class="text-muted"> ${text}</span></p>
    `;

    // Menambahkan ke daftar notifikasi
    notificationList.appendChild(newNotification);

    // Update jumlah notifikasi
    let currentCount = parseInt(notificationCount.innerText) || 0;
    notificationCount.innerText = currentCount + 1;
}
