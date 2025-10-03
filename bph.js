// Animasi saat scroll dan interaksi foto
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.card, .division-card');
    const photos = document.querySelectorAll('.profile-photo, .division-lead-photo, .member-photo');
    
    // Observer untuk animasi scroll
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = 0;
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Efek hover pada foto
    photos.forEach(photo => {
        photo.addEventListener('mouseenter', () => {
            photo.style.transform = 'scale(1.05)';
            photo.style.transition = 'transform 0.3s ease';
        });
        
        photo.addEventListener('mouseleave', () => {
            photo.style.transform = 'scale(1)';
        });
    });

    // Efek klik pada foto untuk menampilkan informasi
    photos.forEach(photo => {
        photo.addEventListener('click', () => {
            const name = photo.alt;
            const info = photo.parentElement.querySelector('p')?.textContent || 
                         photo.parentElement.parentElement.querySelector('h4')?.textContent || 
                         'Anggota Tim';
            
            // Membuat popup sederhana
            const popup = document.createElement('div');
            popup.className = 'photo-popup';
            popup.innerHTML = `
                <div class="popup-content">
                    <img src="${photo.src}" alt="${name}">
                    <h3>${name}</h3>
                    <p>${info}</p>
                    <button class="close-btn">Tutup</button>
                </div>
            `;
            
            document.body.appendChild(popup);
            
            // Animasi popup
            setTimeout(() => {
                popup.style.opacity = 1;
            }, 10);
            
            // Event untuk menutup popup
            popup.querySelector('.close-btn').addEventListener('click', () => {
                popup.style.opacity = 0;
                setTimeout(() => {
                    document.body.removeChild(popup);
                }, 300);
            });
        });
    });
});

// Menambahkan style untuk popup (dilakukan via JS agar tidak mempengaruhi file CSS)
const style = document.createElement('style');
style.textContent = `
    .photo-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .popup-content {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        text-align: center;
        max-width: 400px;
        width: 90%;
    }
    
    .popup-content img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary);
        margin-bottom: 1rem;
    }
    
    .popup-content h3 {
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    
    .close-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        cursor: pointer;
        margin-top: 1rem;
        transition: background 0.3s ease;
    }
    
    .close-btn:hover {
        background: var(--secondary);
    }
`;
document.head.appendChild(style);