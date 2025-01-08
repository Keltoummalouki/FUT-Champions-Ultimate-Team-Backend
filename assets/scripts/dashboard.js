const themeSwitcher = document.getElementById("theme-switcher");
const body = document.body;
let playersData;
if (!localStorage.getItem("theme")) {
    localStorage.setItem("theme", "light");
}

body.className = localStorage.getItem("theme");
themeSwitcher.addEventListener("click", () => {
    const currentTheme = body.className;
    const newTheme = currentTheme === "light" ? "dark" : "light";
    body.className = newTheme;
    localStorage.setItem("theme", newTheme);
    themeSwitcher.textContent = newTheme === "light" ? "🌙" : "☀️";
});


let menuicn = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicn.addEventListener("click", () => {
    nav.classList.toggle("navclose");
})

document.querySelector("#add-btn").addEventListener("click", function() {
    document.querySelector(".popup").classList.add("active");
});

document.querySelector(".popup .close-btn").addEventListener("click", function() {
    document.querySelector(".popup").classList.remove("active");
});

function updateFieldsBasedOnPosition(position) {
    const numericFieldsContainer = document.querySelector(".formation");

    if (!numericFieldsContainer) {
        console.error("Le conteneur '.formation' est introuvable !");
        return;
    }

    const goalkeeperFields = [
        { label: "Handling", id: "handling" },
        { label: "Kicking", id: "kicking" },
        { label: "Reflexes", id: "reflexes" },
        { label: "Speed", id: "speed" },
        { label: "Positioning", id: "positioning" }
    ];

    const defaultFields = [
        { label: "Pace", id: "pace" },
        { label: "Shooting", id: "shooting" },
        { label: "Passing", id: "passing" },
        { label: "Dribbling", id: "dribbling" },
        { label: "Defending", id: "defending" },
        { label: "Physical", id: "physical" }
    ];

    const fields = position === "Goalkeeper (GK)" ? goalkeeperFields : defaultFields;

    numericFieldsContainer.innerHTML = '';
    fields.forEach(field => {
        const divFormation = document.createElement("div");
        const fieldDiv = document.createElement("div");
        const label = document.createElement("label");
        label.setAttribute("for", field.id);
        label.textContent = field.label;

        divFormation.classList.add("stats-form");
        console.log(divFormation)

        const input = document.createElement("input");
        input.type = "number";
        input.id = field.id;
        input.name = field.id;
        input.classList.add("inputs");
        input.placeholder = field.label;

        const span = document.createElement("span");
        span.classList.add("erreur-message");
        span.id = `erreur-${field.id}`;

        fieldDiv.appendChild(label);
        fieldDiv.appendChild(input);
        fieldDiv.appendChild(span);
        divFormation.appendChild(fieldDiv)
        numericFieldsContainer.appendChild(divFormation);
    });


    if (document.getElementById('position').value === "Goalkeeper (GK)") {
        const goalkeepingFields = ["handling", "kicking", "reflexes", "speed", "positioning"];
        goalkeepingFields.forEach(field => {
            let value = parseInt(document.getElementById(field).value);
            if (isNaN(value) || value < 20 || value > 99) {
                document.getElementById(`erreur-${field}`).innerText = `${field.charAt(0).toUpperCase() + field.slice(1)} must be between 20 and 99.`;
                document.getElementById(`erreur-${field}`).style.color = 'red';
                errors = true;
            } else {
                document.getElementById(`erreur-${field}`).innerText = ''
            }
        });
    }
}

function validateForm() {
    let errors = false;
    const fields = [
        { id: "flag", errorId: "erreur-flag", errorMsg: "Flag is required." },
        { id: "logo", errorId: "erreur-logo", errorMsg: "Logo is required." },
        { id: "photo", errorId: "erreur-image", errorMsg: "Player photo URL is required." },
        { id: "name", errorId: "erreur-name", errorMsg: "Name is required." },
        { id: "rating", errorId: "erreur-rating", errorMsg: "Rating is required." },
        { id: "position", errorId: "erreur-position", errorMsg: "Position is required." },
        { id: "nationality", errorId: "erreur-nationality", errorMsg: "Nationality is required." },
        { id: "club", errorId: "erreur-club", errorMsg: "Club is required." },

    ];


    for (let i = 0; i < fields.length; i++) {
        let span = document.getElementById(fields[i].errorId)
        if (document.getElementById(fields[i].id).value === "") {
            span.innerText = fields[i].errorMsg
            span.style.color = 'red'
            errors = true;
        } else {
            span.innerText = ''
            errors = false;
        }
    }


    const numericFields = [
        "rating", "pace", "shooting", "passing", "dribbling", "defending", "physical",
        "handling", "kicking", "positioning", "reflexes", "speed"
    ];

    numericFields.forEach(field => {
        let value = parseInt(document.getElementById(field).value);
        if (isNaN(value) || value < 20 || value > 99) {
            document.getElementById(`erreur-${field}`).innerText = `${field.charAt(0).toUpperCase() + field.slice(1)} must be between 20 and 99.`;
            document.getElementById(`erreur-${field}`).style.color = 'red';
            errors = true;
        } else {
            document.getElementById(`erreur-${field}`).innerText = "";
        }
    });

    return !errors;
}

document.getElementById("position").addEventListener("change", function () {
    updateFieldsBasedOnPosition(this.value);
});

document.getElementById('myForm').addEventListener('submit', (e) => {
    e.preventDefault();
    if (validateForm()) {
        alert('Form submitted successfully!');
    }
});