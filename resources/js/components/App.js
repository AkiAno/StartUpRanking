import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Chart from "./graphs/chart.js";

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <br />
                    <Chart />
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<App />, document.getElementById("react-graph"));
