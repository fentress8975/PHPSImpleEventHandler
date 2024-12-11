<?php
trait EventHandler
{
    // List of all subcribers objHash=>objMethod
    private array $subscribersList = array();
    // List of all objects objHash=>obj
    private array $objectsHashList = array();

    // Add method to subscribers
    public function addListener(object &$object, string $methodName): bool
    {
        //Check if method exist in class
        if (method_exists($object, $methodName)) {
            $hash = spl_object_hash($object);
            $this->objectsHashList[$hash] = $object;
            $this->subscribersList[$hash] = $methodName;
            return true;
        } else {
            throw new Exception("Method $methodName not exist in " . get_class($object), 1);
        }
    }
    //Remove method from subscribers  obj=>objMethod
    public function removeListener(&$object, string $methodName): bool
    {
        $hash = spl_object_hash($object);
        $key = array_search($methodName, $this->subscribersList);
        //Check if key from method list equals form obj list
        if ($key === $hash) {
            unset($this->subscribersList[$hash]);
            unset($this->objectsHashList[$hash]);
            return true;
        } else {
            throw new Exception("Trying to remove not existing method $methodName class " . get_class($object) . " in subcribers ", 1);
        }
    }
    //Wipe list
    public function removeAllListeners(): bool
    {
        unset($this->subscribersList);
        unset($this->objectsHashList);
        return true;
    }
    //Invoke all subscribers
    public function invoke($value): bool
    {
        try {
            foreach ($this->subscribersList as $objHash => $objMethod) {
                $obj = $this->objectsHashList[$objHash];

                call_user_func([$obj, $objMethod], $value);
            }
            return true;
        } catch (\Throwable $th) {
            //throw $th; 
        }
    }
}
