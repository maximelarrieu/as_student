import React from 'react'
import {Button} from '@material-ui/core'

import "../styles/Home.css"


function Home() {
    return ( 
        <div className="center">
            <img src="" alt="avatar"/>
            <h1>Welcome</h1>
            <Button variant="contained" color="primary">
                <a href="/game">Take a new game</a>
            </Button>
        </div>
    )
}

export default Home