import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Navbar from "./navbar/Navbar";
import Calendar from "./date-picker/date-picker";
import Footer from "./footer/footer";
import Chart from "./graphs/chart.js";

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Navbar />
                    <div className="container d-flex justify-content-center mt-4">
                        <Calendar id="date_one" />
                        <Calendar id="date_two" />
                        <button className="btn-submit">select</button>
                    </div>
                    <br />
                    <Chart />
                    <Footer />
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<App />, document.getElementById("app"));
