import './App.css';
import './css/BootstrapMin.css';
import './css/BootstrapIcons.css';
import './css/TooplateCrispyKitchen.css';
import Pheader from './components/Pageheader';
import Pfooter from './components/Pagefooter';
import Pcontent from './components/MainContent';
import About from './components/About';
import Contact from './components/Contact';
import { BrowserRouter as Router,Route,Switch} from "react-router-dom";

function App() {
  return (
    <>
      <Router>
        <Pheader />
            <Switch>
                <Route exact path="/about">  <About /> </Route>
                <Route exact path="/" > <Pcontent /> </Route>
                <Route exact path="/contact" > <Contact /> </Route>
            </Switch>
        <Pfooter />
      </Router>
    </>
  );
}

export default App;
