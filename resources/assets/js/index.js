import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6a4043788c762cfe9306'
});

window.Echo.channel('solutions')
    .listen('SolutionCreated', (solution) => {
    	// console.log(solution);
		let table = document.getElementById("solutionsTable");

		// Create an empty <tr> element and add it to the 1st position of the table:
		let row = table.insertRow(1);

		// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
		let cell1 = row.insertCell(0);
		let cell2 = row.insertCell(1);
		let cell3 = row.insertCell(2);
		let cell4 = row.insertCell(3);
		let cell5 = row.insertCell(4);
		let cell51 = row.insertCell(5);
		let cell6 = row.insertCell(6);
		let cell7 = row.insertCell(7);
		let cell8 = row.insertCell(8);
		let cell9 = row.insertCell(9);
		let cell10 = row.insertCell(10);							

		// Add some text to the new cells:
		cell1.innerHTML = `<td> ${solution.id}</td>`;
		cell2.innerHTML = `<td> ${solution.nbNodes}</td>`;
		cell3.innerHTML = `<td> <pre>${solution.parameters || "-"}</pre></td>`;
		cell4.innerHTML = `<td> ${solution.nbOpen}</td>`;
		cell5.innerHTML = `<td> ${solution.objValue.toLocaleString()}</td>`;
		cell51.innerHTML = `<td> ${(solution.gap * 100).toFixed(2)}</td>`;
		cell6.innerHTML = `<td> ${solution.solutionTime.toFixed(2)}</td>`;
		cell7.innerHTML = `<td> ${solution.nbCuts || "-"}</td>`;
		cell8.innerHTML = `<td> ${solution.solver}</td>`;
		cell9.innerHTML = `<td> ${solution.created_at}</td>`;
		cell10.innerHTML = `<td> <a href="/solutions/${solution.id}">View</a> </td>`;

		if(table.rows.length > 16)
			table.deleteRow(-1);	
    });

