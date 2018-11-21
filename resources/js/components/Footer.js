import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";

class Footer extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Footer />
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<Footer />, document.getElementById("react-footer"));
