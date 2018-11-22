require("./loader.js");

class DataTable {
    constructor(url) {
        this.url = url;
        this.loading = false;
    }
    //change to the right url
    renderLoader() {
        return '<div class="loader"></div>';
    }
    display(code) {
        let container = document.querySelector(".data.container");
        container.innerHTML = code;
    }

    load(first_date, second_date) {
        let loader = this.renderLoader();
        this.display(loader);
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
