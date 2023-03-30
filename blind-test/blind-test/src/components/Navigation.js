import '../App.css';
import { Provider, useSelector, useDispatch } from 'react-redux'
import { store } from '../store'

import { BrowserRouter as Router, Route, Switch, Redirect} from 'react-router-dom'

import NavBar from './NavBar'
import Home from './Home'
import Game from './Game'
import Question from './Question'
import Profile from './Profile'
import Result from './Result'
import Authenticate from './Authenticate'
import Register from './Register';

const PrivateRoute = ({ children, ...rest }) => {
    const isAuthenticated = useSelector(
      (state) => state.user.isAuthenticated
    );
    return (
      <Route
        {...rest}
        render={({ location }) =>
          isAuthenticated ? (
            children
          ) : (
            <Redirect
              to={{
                pathname: "/login",
                state: { from: location },
              }}
            />
          )
        }
      />
    );
  };

function Navigation() {
      const isAuthenticated = useSelector(
      (state) => state.user.isAuthenticated
    );

  // const isLoading = useSelector((state) => state.app.isLoading)
  // const isAuthenticated = useSelector((state) => state.app.user !=null)
  // const dispatch = useDispatch();
  // const player = useSelector((state) => state.user.player)
  // console.log(player)
  return (
    <Router>
      <NavBar />
      <Switch>
        <Route path="/register">{isAuthenticated ? <Redirect to="/profile" /> : <Register />}</Route>
        <Route path="/login">{isAuthenticated ? <Redirect to="/profile" /> : <Authenticate />}</Route>
        <Route path="/game" component={Game} />
        <Route path="/question" component={Question} />
        <Route path="/result" component={Result} />
        <Route path="/profile">
            <Profile />
        </Route>
        <Route path="/">
            <Home />
        </Route>
      </Switch>
    </Router>
  );
}

export default Navigation;
