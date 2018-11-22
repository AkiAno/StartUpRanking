import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Chart from "./graphs/chart.js";
import Picker from "./date-picker/date-picker.js";

class Calendar extends Component {
    handleSubmit(e) {
        console.log(e.target.value);
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
