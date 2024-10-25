const form = document.getElementById('reservation-form');
const checkinInput = document.getElementById('checkin');
const checkoutInput = document.getElementById('checkout');
const roomSelect = document.getElementById('room');
const adultsInput = document.getElementById('adults');
const childrenInput = document.getElementById('children');
const availabilityDiv = document.getElementById('availability');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const checkinDate = new Date(checkinInput.value);
    const checkoutDate = new Date(checkoutInput.value);
    const roomType = roomSelect.value;
    const adults = parseInt(adultsInput.value);
    const children = parseInt(childrenInput.value);
    const availability = checkAvailability(checkinDate, checkoutDate, roomType, adults, children);
    displayAvailability(availability);
});

function checkAvailability(checkinDate, checkoutDate, roomType, adults, children) {
    // Aquí va la lógica para verificar la disponibilidad de las fechas y habitaciones
    // Por ahora, solo devuelve un objeto con una propiedad "available" que indica si la fecha y habitación están disponibles
    const roomCapacity = getRoomCapacity(roomType);
    if (roomCapacity >= adults + children) {
        // Verificar disponibilidad de fechas
        const datesAvailable = checkDatesAvailability(checkinDate, checkoutDate);
        if (datesAvailable) {
            return { available: true };
        } else {
            return { available: false, message: 'Las fechas no están disponibles' };
        }
    } else {
        return { available: false, message: 'La habitación no tiene capacidad suficiente' };
    }
}

function getRoomCapacity(roomType) {
    // Aquí va la lógica para obtener la capacidad de la habitación
    // Por ahora, devuelve una capacidad fija para cada tipo de habitación
    switch (roomType) {
        case 'single':
            return 1;
        case 'double':
            return 2;
        case 'suite':
            return 3;
        case 'junior-suite':
            return 2;
        case 'presidential-suite':
            return 4;
        default:
            return 0;
    }
}

function checkDatesAvailability(checkinDate, checkoutDate) {
    // Aquí va la lógica para verificar la disponibilidad de las fechas
    // Por ahora, devuelve true si las fechas están disponibles
    return true;
}

function displayAvailability(availability) {
    if (availability.available) {
        availabilityDiv.innerHTML = `La fecha y habitación están disponibles. ¡Reserva con éxito!`;
    } else {
        availabilityDiv.innerHTML = `Lo sentimos, ${availability.message}`;
    }
}