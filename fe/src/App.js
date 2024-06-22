import {Route,Routes} from "react-router-dom";
import Home from "./pages/Home";
import Tests from "./pages/Tests";
import DashBoard from "./pages/DashBoard";


function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />}></Route>
      <Route path="/test" element={<Tests />}></Route>
      <Route path="/dashboard" element={<DashBoard/>}></Route>
      
    </Routes>
    
  );
}

export default App;
