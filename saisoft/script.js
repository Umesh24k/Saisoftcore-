function closePopup() {
    document.getElementById('entryPopup').style.display = 'none';
}

// Generate 50 Reviews
const container = document.getElementById('reviewContainer');
const names = ["Rajesh", "Amit", "Sneha", "Vikram", "Priya", "Sunil"];

for(let i=1; i<=50; i++) {
    let div = document.createElement('div');
    div.className = 'rev-card';
    div.innerHTML = `
        <strong>${names[i % names.length]} M.</strong>
        <p>⭐ ⭐ ⭐ ⭐ ⭐</p>
        <p>"Excellent Tally support for our business in ${i%2==0 ? 'Jalna' : 'Sambhajinagar'}!"</p>
    `;
    container.appendChild(div);
}