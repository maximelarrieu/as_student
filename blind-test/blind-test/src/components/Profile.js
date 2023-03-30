import React from 'react'
import {signOutFromAuth} from '../firebase'
import { useEffect, useState, useDispatch } from "react";
import {Button} from '@material-ui/core'
import '../styles/Home.css'
import { useSelector } from 'react-redux'

function Profile() {
    const player = useSelector((state) => state)
    console.log(player.name)
    console.log(player)
    return (
        <div className="center">
            <img src="https://icotar.com/initials/user" alt="avatar" style={{width: 50}}/>
            {/* <h2>Hello {props.name}</h2> */}
            <h2>Hello {player.name}</h2>
            <Button onClick={() => signOutFromAuth()} variant="contained" color="primary">
                Sign Out
            </Button>
        </div>
    )
}

export default Profile