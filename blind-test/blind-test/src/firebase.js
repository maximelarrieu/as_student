import firebase from 'firebase/app';
import 'firebase/auth';
import api from "./api";
import { appActions } from "./actions/appActions";
import { getPlayerData } from "./effects/playerEffects";

export const initFirebase = () => {
  const firebaseConfig = {
    apiKey: "AIzaSyAoi_dkAeY1FFdLPmWS5voHjbIxegqSzw8",
    authDomain: "ynov-b3-21.firebaseapp.com",
    projectId: "ynov-b3-21",
    storageBucket: "ynov-b3-21.appspot.com",
    messagingSenderId: "223121527532",
    appId: "1:223121527532:web:3384aee092f596b0b00bc9",
    measurementId: "G-VN2VY6XM1J",
  };
  // Initialize Firebase
  if (firebase.apps.length === 0) {
    firebase.initializeApp(firebaseConfig);
  }
};

export const listenAuthChanged = (handleUser, handleAnonymous) => {
  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      // User is authenticated
      handleUser(user);
    } else {
      // Anonymous
      handleAnonymous();
    }
  });
};

export const signOutFromAuth = () => {
  firebase.auth().signOut();
};

export const signin = (email, password, dispatch) => {
  dispatch({ type: appActions.APP_IS_LOADING });
  return firebase
    .auth()
    .signInWithEmailAndPassword(email, password)
    .then((userCreds) => {
      console.log(userCreds.user.uid);
    })
    .catch((err) => {
      console.log(err);
      alert("Error", err.message);
    });
};

export const signup = (
  email,
  password,
  playerName,
  dispatch,
) => {
  dispatch({ type: appActions.APP_IS_LOADING });
  return firebase
    .auth()
    .createUserWithEmailAndPassword(email, password)
    .then((userCreds) => {
      // Create the player in firestore
      api.createPlayer(userCreds.user.uid, playerName)
      .then(() => {
        console.log(userCreds.user.uid);
        dispatch(getPlayerData());
      });
    })
    .catch((err) => {
      console.log(err);
      alert("Error", err.message);
    });
};