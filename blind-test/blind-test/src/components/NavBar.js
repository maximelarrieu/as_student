import React from 'react'
import { useDispatch, useSelector } from "react-redux";

import {AppBar, Toolbar, Button} from '@material-ui/core';

function NavBar() {
    const isAuthenticated = useSelector(
        (state) => state.user.isAuthenticated
    );
    return (
        <AppBar position="static">
            <Toolbar>
                
                {
                    isAuthenticated ?
                    <>
                    <Button>
                        <a href="/game">Game</a>
                    </Button>
                    <Button>
                        <a href="/profile">Profile</a>
                    </Button>
                    </>
                    :
                    <>
                    <Button>
                        <a href="/login">Login</a>
                    </Button>                    
                    <Button>
                        <a href="/register">Register</a>
                    </Button>
                    </>                 
                }

            </Toolbar>
        </AppBar>
    )
}

export default NavBar