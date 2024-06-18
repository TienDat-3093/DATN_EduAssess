import {Route,Routes} from "react-router-dom";
import Home from "./pages/Home";
import Tests from "./pages/Tests";

function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />}></Route>
      <Route path="/test" element={<Tests />}></Route>
    </Routes>
    
  );
}

export default App;
