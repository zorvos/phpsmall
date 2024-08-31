document.addEventListener('DOMContentLoaded', () => {
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const table = document.querySelector('table');

    searchForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const query = searchInput.value;

        fetch(`search.php?search=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                let html = '<tr><th>Naslov</th><th>Opis</th><th>Status</th><th>Akcija</th></tr>';
                data.forEach(task => {
                    html += `<tr>
                        <td>${task.title}</td>
                        <td>${task.description}</td>
                        <td>${task.status}</td>
                        <td>
                            <a href="edit.php?id=${task.id}">Izmeni</a>
                            <a href="delete.php?id=${task.id}" onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj zadatak?')">Obriši</a>
                        </td>
                    </tr>`;
                });
                table.innerHTML = html;
            });
    });
});
