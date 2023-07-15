
// --------------------------Search bar -------------------------------

const searchBar = () => {
    // get input value
    const inputSearch = document.getElementById('search').value.toLowerCase();

    //get all cars
    const cars = document.querySelectorAll('#card');
    cars.forEach( (car) => {
        // get all data I need from cars
        const carBrand = car.querySelector('#car-brand').textContent.toLowerCase();
        const carGear = car.querySelector('#gearbox').textContent.toLowerCase();
        const carFuel = car.querySelector('#fuel').textContent.toLowerCase();
        const carEquipments = car.querySelector('#equipments').textContent.toLowerCase();

        // Search filters
        const brandFilter = carBrand.includes(inputSearch);
        const gearFilter = carGear.includes(inputSearch);
        const fuelFilter = carFuel.includes(inputSearch);
        const equipmentsFilter = carEquipments.includes(inputSearch);
        console.log(brandFilter, gearFilter, fuelFilter, equipmentsFilter);

        // Show cars that match with search
        if (brandFilter ||  gearFilter || fuelFilter || equipmentsFilter) {
            car.style.display = 'block';
        } else {
            car.style.display = 'none';
        }
    });
};

document.getElementById('search').addEventListener('keyup', searchBar);

// --------------------------Filter cars -------------------------------
function filterCars() {
    // get all cars 
    const cars = document.querySelectorAll('#card');

    // Loop through cars
    cars.forEach( (car) => {
        // Get all my buttons filters
        const all = document.getElementById('all').checked;
        // Gearbox
        const manualGear = document.getElementById('manual').checked;
        const autoGear = document.getElementById('auto').checked;
        // Fuel
        const essence = document.getElementById('essence').checked;
        const diesel = document.getElementById('diesel').checked;
        const electric = document.getElementById('elec').checked;
        const hybrid = document.getElementById('hybrid').checked;

        // change background-color when checkbox is checked
        const labels = document.querySelectorAll('.badge');
        labels.forEach( (label) => {
            if (all, manualGear, autoGear, essence, diesel, electric, hybrid) {
                label.classList.replace('bg-primary', 'bg-danger');
            } else {
                label.classList.replace('bg-danger', 'bg-primary');
            }
        });


        // Get all data I need from cars
        // Gearbox
        const carGear = car.querySelector('#gearbox').textContent;
        // Fuel
        const carFuel = car.querySelector('#fuel').textContent;


        // Filters (true or false)
        // Gearbox
        const gearManualFilter = manualGear && carGear.toLowerCase().includes('manuelle');
        const gearAutoFilter = autoGear && carGear.toLowerCase().includes('automatique');

        // Fuel
        const fuelEssenceFilter = essence && carFuel.toLowerCase().includes('essence');
        const fuelDieselFilter = diesel && carFuel.toLowerCase().includes('diesel');
        const fuelElectricFilter = electric && carFuel.toLowerCase().includes('electrique');
        const fuelHybridFilter = hybrid && carFuel.toLowerCase().includes('hybride');


        
        if (gearManualFilter || gearAutoFilter || fuelEssenceFilter || fuelDieselFilter || fuelElectricFilter || fuelHybridFilter) {
            car.style.display = 'block';
        } else {
            car.style.display = 'none';
        }

        // Show all cars if none is checked
        if (all || !manualGear && !autoGear && !essence && !diesel && !electric && !hybrid) {
            car.style.display = 'block';
        }
    });
}

document.getElementById('all').addEventListener('click', filterCars);
document.getElementById('manual').addEventListener('click', filterCars);
document.getElementById('auto').addEventListener('click', filterCars);
document.getElementById('essence').addEventListener('click', filterCars);
document.getElementById('diesel').addEventListener('click', filterCars);
document.getElementById('elec').addEventListener('click', filterCars);
document.getElementById('hybrid').addEventListener('click', filterCars);


