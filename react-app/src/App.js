import React from 'react';
import {Route,Switch} from 'react-router-dom';
import './App.css';

import AddSubscriber from "./components/AddSubscriber";
import Subscribers from "./components/Subscribers";

export default function App() {
    return (
      <div className="App">
        <Switch>
          <Route path="/subscribe" exact component={AddSubscriber} />
          <Route path="/" exact component={Subscribers} />
        </Switch>
      </div>
    );
  }