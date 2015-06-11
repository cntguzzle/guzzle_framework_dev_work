
# Guzzle Development Notes

## What is the difference between the functions:

```
getBody()
```
```
getBody()->getContents()
```

### Guzzle source code reference
```
public function getContents($maxLength = -1)
  {
      return $this->getBody()->getContents();
  }
```
