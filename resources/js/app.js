document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function() {
        const query = this.value;

        fetch(`/search-tracks?query=${query}`) // Предполагается, что у вас есть маршрут /search-tracks для обработки запросов поиска
            .then(response => response.json())
            .then(data => {
                const searchResults = document.getElementById('searchResults');
                searchResults.innerHTML = ''; // Очистите текущие результаты

                data.tracks.forEach(track => {
                    // Добавьте каждый результат в searchResults. Это пример, настройте под ваш HTML.
                    const div = document.createElement('div');
                    div.className = 'col-md-4';
                    div.innerHTML = `
                        <div class="card mb-4">
                            <div class="card-img-top" style="background-image: url('/storage/${track.cover}'); background-size: cover; background-position: center; height: 300px;"></div>
                            <div class="card-body">
                                <h5 class="card-title">${track.title}</h5>
                                <p class="card-text">${track.artist}</p>
                                <audio controls>
                                    <source src="/storage/${track.file}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    `;
                    searchResults.appendChild(div);
                });
            })
            .catch(error => console.error('Error:', error));
    });
});
