let countriesData = [];

window.onload = function() {
    loadCountries();
}

async function loadCountries() {
    const response = await fetch('./php/pais_listar.php');
    const countries = await response.json();
    countriesData = countries;

    let tableBody = document.getElementById('countriesTableBody');
    tableBody.innerHTML = ''; 

    countries.forEach(country => {
        let row = document.createElement('tr');
        row.innerHTML = `
            <td>${country.id}</td>
            <td>${country.nome}</td>
            <td>${country.capital}</td>
            <td>${country.regiao}</td>
            <td>${country.populacao}</td>
            <td>${country.area}</td>
            <td>
                <button class="editBtn" data-id="${country.id}">Alterar</button>
                <button class="deleteBtn" data-id="${country.id}">Excluir</button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = button.getAttribute('data-id');
            editCountry(id);
        });
    });

    document.querySelectorAll('.deleteBtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = button.getAttribute('data-id');
            deleteCountry(id);
        });
    });
}



function addCountry() {
    const countryName = document.getElementById('addCountry').value;
    fetch(`https://restcountries.com/v3.1/name/${countryName}`)
        .then(response => response.json())
        .then(data => {
            const country = data[0];
            const countryObj = {
                nome: country.name.common,
                capital: country.capital ? country.capital[0] : 'N/A',
                regiao: country.region,
                populacao: country.population,
                area: country.area
            };

            fetch(`./php/pais_inserir.php?nome=${countryObj.nome}&capital=${countryObj.capital}&regiao=${countryObj.regiao}&populacao=${countryObj.populacao}&area=${countryObj.area}`)
                .then(() => loadCountries());
        })
        .catch(() => {
            alert('País não encontrado!');
        });
}

function createNewCountry() {
    document.getElementById('newCountryModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('newCountryModal').style.display = 'none';
}


function saveNewCountry() {
    const name = document.getElementById('countryName').value;
    const capital = document.getElementById('capital').value;
    const region = document.getElementById('region').value;
    const population = document.getElementById('population').value;
    const area = document.getElementById('area').value;

    fetch(`./php/pais_inserir.php?nome=${name}&capital=${capital}&regiao=${region}&populacao=${population}&area=${area}`)
        .then(() => {
            loadCountries();
            closeModal();
        });
}


function editCountry(id) {
    const country = countriesData.find(country => country.id === id);
    if (country) {
        document.getElementById('countryName').value = country.nome;
        document.getElementById('capital').value = country.capital;
        document.getElementById('region').value = country.regiao;
        document.getElementById('population').value = country.populacao;
        document.getElementById('area').value = country.area;
        createNewCountry();
        countriesData = countriesData.filter(country => country.id !== id);
    }
}


function deleteCountry(id) {
    if (confirm("Tem certeza que deseja excluir este país?")) {
        fetch(`./php/pais_excluir.php?id=${id}`)
            .then(() => loadCountries());
    }
}


