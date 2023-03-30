import {React, useState} from 'react'
import {connect, useDispatch} from 'react-redux'
import {signup} from '../firebase'
import {appActions} from "../actions/appActions"
import { Redirect } from 'react-router-dom'

import "../styles/Home.css"

import { Input, TextField, Button } from '@material-ui/core'

const RegisterComponent = () => {
    const [setPlayerName, playerName] = useState('')
    const [setEmail, email] = useState('')
    const [password, setPassword] = useState('')
    const [state, setState] = useState({
      email: "",
      password: "",
      playername: ""
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
      event.preventDefault();
      // dispatch({ type: appActions.APP_IS_LOADING });
      signup(
        state.email,
        state.password,
        state.playername,
        dispatch,
        )
    }

    return(
        <div className="center">
            <h1>Register</h1>
            <form noValidate autoComplete="off" onSubmit={handleSubmit}>
              <p>
              <TextField id="filled-basic" label="Username" variant="filled" name="playername" value={state.playername} onChange={handleInputChange} />
              </p>
              <p>
              <TextField id="filled-basic" label="Email" variant="filled" name="email" value={state.email} onChange={handleInputChange}/>
              </p>
              <p>
              <TextField id="outlined-basic" type="password" label="Password" variant="filled" name="password" value={state.password} onChange={handleInputChange}/>
              </p>
              <Button variant="contained" color="primary" type="submit">Sign Up</Button>
            </form>
        </div>
    )
}
export default RegisterComponent