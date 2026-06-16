fetch("index.php?action=api_medical_index")
    .then(response => response.json())
    .then(data => {     
        const medicalTableBody = document.getElementById("medicalTableBody");
        medicalTableBody.innerHTML = ""; // Clear existing rows
        data.forEach(medical => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${medical.id}</td>
                <td>${medical.name}</td>
                <td>${medical.description}</td>
                <td>${medical.price}</td>
                <td>${medical.stock}</td>
                <td></td>   
            `;              
            medicalTableBody.appendChild(row);
        }                       
    })
    .catch(error => console.error("Error fetching medical data:", error));
    