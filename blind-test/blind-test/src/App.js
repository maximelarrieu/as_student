import "./App.css";

import React, { useEffect } from "react";
import { Provider, useSelector, useDispatch } from "react-redux";
import { store } from "./store";
import { launchApp } from "./effects/appEffects";


import { BrowserRouter as Router, Route, Switch, Redirect} from 'react-router-dom'

import NavBar from './components/NavBar'
import Home from './components/Home'
import Game from './components/Game'
import Question from './components/Question'
import Profile from './components/Profile'
import Result from './components/Result'
import Authenticate from './components/Authenticate'
import Register from './components/Register';
import Navigation from './components/Navigation'

function App() {
  // const isLoading = useSelector((state) => state.app.isLoading)
  // const isAuthenticated = useSelector((state) => state.user !== null)
  const isAuthenticated = useSelector(
      (state) => state.user.isAuthenticated
    );
  const dispatch = useDispatch();
  useEffect(() => {
    dispatch(launchApp());
  }, []);

  return (
    <Router>
      <NavBar />
      <Switch>
        <Route path="/register">{isAuthenticated ? <Redirect to="/profile" /> : <Register />}</Route>
        <Route path="/login">{isAuthenticated ? <Redirect to="/profile" /> : <Authenticate />}</Route>
        <Route path="/game">{isAuthenticated ? <Game /> : <Authenticate />}</Route>
        <Route path="/question">{isAuthenticated ? <Question /> : <Authenticate />}</Route>
        <Route path="/result">{isAuthenticated ? <Result /> : <Authenticate />}</Route>
        <Route path="/profile">
            {isAuthenticated ? <Profile /> : <Authenticate />}
        </Route>
        <Route path="/">
            {isAuthenticated ? <Home /> : <Authenticate />}
        </Route>
      </Switch>
    </Router>
  );
}

const MyProvider = () => (
  <Provider store={store}>
    <App />
  </Provider>
)

export default MyProvider


