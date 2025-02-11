function showAddUserForm() {
    document.getElementById('editEmail').value = '';
    document.getElementById('userForm').style.display = 'block';
}

function editUser(email) {
    fetch(`http://localhost:8000/backend/router.php?email=${email}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('User not found');
            }
            return response.json();
        })
        .then(user => {
            document.getElementById('editEmail').value = user.email;
            document.getElementById('firstName').value = user.first_name;
            document.getElementById('lastName').value = user.last_name;
            document.getElementById('email').value = user.email;
            document.getElementById('company').value = user.company_name || '';
            document.getElementById('position').value = user.position || '';
            document.getElementById('phone1').value = user.phone1 || '';
            document.getElementById('phone2').value = user.phone2 || '';
            document.getElementById('phone3').value = user.phone3 || '';
            document.getElementById('userForm').style.display = 'block';
        })
        .catch(error => console.error(error));
}

function saveUser() {
    let data = {
        first_name: document.getElementById('firstName').value,
        last_name: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        company_name: document.getElementById('company').value,
        position: document.getElementById('position').value,
        phones: [
            document.getElementById('phone1').value,
            document.getElementById('phone2').value,
            document.getElementById('phone3').value
        ].filter(phone => phone) // Удаляем пустые телефоны
    };

    let email = document.getElementById('editEmail').value;
    let method = email ? 'PUT' : 'POST';
    let url = email ? `http://localhost:8000/backend/router.php?email=${email}` : 'http://localhost:8000/backend/router.php';

    fetch(url, {
        method: method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(response => {
        if (!response.ok) {
            return response.json().then(error => { throw new Error(error.error); });
        }
        return response.json();
    }).then(() => location.reload())
    .catch(error => alert(error.message));
}

function deleteUser(email) {
    if (confirm('Are you sure?')) {
        fetch(`http://localhost:8000/backend/router.php?email=${email}`, { method: 'DELETE' })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(error => { throw new Error(error.error); });
                }
                return response.json();
            })
            .then(() => location.reload())
            .catch(error => alert(error.message));
    }
}
