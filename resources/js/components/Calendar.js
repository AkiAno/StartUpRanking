import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Chart from "./graphs/chart.js";
import Picker from "./date-picker/date-picker.js";
import DataTable from "../data-table.js";

class Calendar extends Component {
    handleSubmit(e) {
        e.preventDefault();
        let first_date = document.getElementById("first-date").value;
        let second_date = document.getElementById("last-date").value;
        let data_table = new DataTable("http://www.final_project.test:8080/");
        data_table.load(first_date, second_date);
    }
    render() {
        return (
            <BrowserRouter>
                <div>
                    <form
                        onSubmit={this.handleSubmit}
                        id="date-form"
                        method="GET"
                    >
                        <Picker id="first-date" />
                        <Picker id="last-date" />
                        <button id="submitBtn" type="submit">
                            select
                        </button>
                    </form>
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<Calendar />, document.getElementById("date-picker"));
