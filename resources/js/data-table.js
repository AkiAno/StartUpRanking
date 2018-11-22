class DataTable {
    constructor(url) {
        this.url = url;
    }
    //change to the right url
    display(code) {
        let container = document.querySelector(".data.container");
        container.innerHTML = code;
    }

    load(first_date, second_date) {
        fetch(
            "/api/dates?from=" +
                encodeURIComponent(first_date) +
                "&to=" +
                encodeURIComponent(second_date),
            {
                method: "GET"
            }
        )
            .then(response => {
                return response.text();
            })
            .then(data => {
                this.display(data);
            });
    }
}

export default DataTable;
