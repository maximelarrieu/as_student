import React, { useState } from "react";
import { useDispatch } from "react-redux";
import { signin, signup } from "../firebase";
import {appActions} from "../actions/appActions"
import { Input, TextField, Button } from '@material-ui/core'

import "../styles/Home.css"

const Authenticate = () => {

  const [state, setState] = useState({
    email: "",
    password: "",
    // playerName: ""
  })

    const dispatch = useDispatch();


  const handleInputChange = (event) => {
    const value = event.target.value
    setState({
      ...state, 
      [event.target.name]: value,
    })
  }

  const handleSubmit = (event) => {
    // dispatch({ type: appActions.APP_IS_LOADING });
    console.log(state.email)
    console.log(state.password)
    // console.log(state.playerName)
    signin(
      state.email,
      state.password,
      dispatch,
      )

    event.preventDefault();


  }

  return (
    <div className="center">
    <h1>Login</h1>
    <form noValidate autoComplete="off" onSubmit={handleSubmit}>
      <p>
      <TextField id="filled-basic" label="Email" variant="filled" name="email" value={state.email} onChange={handleInputChange}/>
      </p>
      <p>
      <TextField id="filled-basic" type="password" label="Password" variant="filled" name="password" value={state.password} onChange={handleInputChange}/>
      </p>
      <Button type="submit" variant="contained" color="primary">Sign In</Button>
    </form>
  </div>
  );
};

export default Authenticate;