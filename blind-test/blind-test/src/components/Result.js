import React from 'react'
import { Button } from '@material-ui/core';

import "../styles/Home.css"

function Result() {
    return (
        <>
        <div class="center">
            <p>Votre score est : score</p>
            <p>Merci d'avoir joué!</p>
            <Button variant="contained" color="primary">REJOUER</Button>
        </div>
        </>
    )
}

export default Result