const pulsante = document.getElementById('searchButton');

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('globalSearchInput');
    const resultsContainer = document.getElementById('globalSearchResults'); // Recupero la lista
    let timeout = null;

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        clearTimeout(timeout);

        if (query.length < 2) {
            resultsContainer.innerHTML = '';
            resultsContainer.style.display = 'none';
            return;
        }

        timeout = setTimeout(() => {
            // Creo uno stream in cui vado a fare il fetch dei valori
            fetch(`${API_SEARCH_URL}?q=${encodeURIComponent(query)}`)
                .then(response => response.json()) // Ottengo il json
                .then(books => {
                    resultsContainer.innerHTML = '';
                    if (books.length > 0) {
                        resultsContainer.style.display = 'block';
                        books.forEach(book => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item list-group-item-action cursor-pointer';

                            li.innerHTML = `
                                ${book.title} - ${book.author}
                            `;

                            li.addEventListener('click', () => {
                                window.location.href = `${BASE_URL}controller/bookPage.php?id=${book.id}`;
                            });

                            resultsContainer.appendChild(li);
                        });
                    } else {
                        // Se non ci sono risultati
                        resultsContainer.innerHTML = '<li class="list-group-item">Nessun risultato</li>';
                        resultsContainer.style.display = 'block';
                    }
                })
                .catch(e => {
                    console.error("Errore fetch:", e);
                    resultsContainer.style.display = 'none';
                });
        }, 300);
    });

    // Chiude i risultati se clicchi fuori
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.style.display = 'none';
        }
    });
});